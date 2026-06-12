(() => {
    const root = document.querySelector('[data-avatar-maker]');

    if (!root) {
        return;
    }

    const config = window.senaAvatarMaker || {};
    const canvas = root.querySelector('[data-avatar-canvas]');
    const camera = root.querySelector('[data-avatar-camera]');
    const input = root.querySelector('[data-avatar-input]');
    const zoomInput = root.querySelector('[data-avatar-zoom]');
    const openCameraButton = root.querySelector('[data-open-camera]');
    const captureButton = root.querySelector('[data-capture-photo]');
    const closeCameraButton = root.querySelector('[data-close-camera]');
    const cameraActions = root.querySelector('[data-camera-actions]');
    const resetButton = root.querySelector('[data-reset-frame]');
    const downloadButton = root.querySelector('[data-download-avatar]');
    const status = root.querySelector('[data-avatar-status]');
    const ctx = canvas ? canvas.getContext('2d') : null;

    if (!canvas || !ctx) {
        return;
    }

    const outputSize = canvas.width;
    const state = {
        photo: null,
        photoUrl: '',
        zoom: 1,
        offsetX: 0,
        offsetY: 0,
        isDragging: false,
        lastPointerX: 0,
        lastPointerY: 0,
        stream: null,
        overlayReady: false,
        overlayFailed: false,
    };

    const overlay = new Image();

    const setStatus = (message) => {
        if (status) {
            status.textContent = message;
        }
    };

    const setEditingEnabled = (enabled) => {
        [zoomInput, resetButton, downloadButton].forEach((control) => {
            if (control) {
                control.disabled = !enabled;
            }
        });
    };

    const getPhotoDimensions = () => {
        if (!state.photo) {
            return { width: 0, height: 0 };
        }

        return {
            width: state.photo.naturalWidth || state.photo.width,
            height: state.photo.naturalHeight || state.photo.height,
        };
    };

    const getDrawMetrics = () => {
        const dimensions = getPhotoDimensions();

        if (!dimensions.width || !dimensions.height) {
            return null;
        }

        const baseScale = Math.max(outputSize / dimensions.width, outputSize / dimensions.height);
        const scale = baseScale * state.zoom;
        const width = dimensions.width * scale;
        const height = dimensions.height * scale;

        return {
            width,
            height,
            x: (outputSize - width) / 2 + state.offsetX,
            y: (outputSize - height) / 2 + state.offsetY,
        };
    };

    const clampFrame = () => {
        const metrics = getDrawMetrics();

        if (!metrics) {
            return;
        }

        const limitX = Math.max(0, (metrics.width - outputSize) / 2);
        const limitY = Math.max(0, (metrics.height - outputSize) / 2);

        state.offsetX = Math.max(-limitX, Math.min(limitX, state.offsetX));
        state.offsetY = Math.max(-limitY, Math.min(limitY, state.offsetY));
    };

    const drawFallbackOverlay = () => {
        ctx.save();
        ctx.lineWidth = 18;
        ctx.strokeStyle = '#004cb2';
        ctx.strokeRect(9, 9, outputSize - 18, outputSize - 18);

        ctx.lineWidth = 8;
        ctx.strokeStyle = '#00bef8';
        ctx.strokeRect(32, 32, outputSize - 64, outputSize - 64);

        ctx.fillStyle = '#ffffff';
        ctx.fillRect(0, outputSize - 210, outputSize, 210);

        ctx.fillStyle = '#004cb2';
        ctx.fillRect(0, outputSize - 222, outputSize, 18);

        ctx.fillStyle = '#00bef8';
        ctx.fillRect(0, outputSize - 222, outputSize * 0.42, 18);

        ctx.fillStyle = '#fac607';
        ctx.fillRect(outputSize * 0.42, outputSize - 222, outputSize * 0.16, 18);

        ctx.fillStyle = '#004cb2';
        ctx.font = '800 70px Archivo, Arial, sans-serif';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText('ULYSSES', outputSize / 2, outputSize - 135);

        ctx.fillStyle = '#00bef8';
        ctx.font = '800 64px Archivo, Arial, sans-serif';
        ctx.fillText('SENA', outputSize / 2, outputSize - 68);
        ctx.restore();
    };

    const drawPlaceholder = () => {
        const gradient = ctx.createLinearGradient(0, 0, outputSize, outputSize);
        gradient.addColorStop(0, '#edf5ff');
        gradient.addColorStop(1, '#dff8ff');
        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, outputSize, outputSize);

        ctx.fillStyle = 'rgba(0, 76, 178, 0.08)';
        for (let line = -outputSize; line < outputSize * 2; line += 90) {
            ctx.beginPath();
            ctx.moveTo(line, outputSize);
            ctx.lineTo(line + outputSize, 0);
            ctx.lineTo(line + outputSize + 34, 0);
            ctx.lineTo(line + 34, outputSize);
            ctx.closePath();
            ctx.fill();
        }
    };

    const draw = () => {
        ctx.clearRect(0, 0, outputSize, outputSize);

        if (state.photo) {
            clampFrame();
            const metrics = getDrawMetrics();

            if (metrics) {
                ctx.drawImage(state.photo, metrics.x, metrics.y, metrics.width, metrics.height);
            }
        } else {
            drawPlaceholder();
        }

        if (state.overlayReady) {
            ctx.drawImage(overlay, 0, 0, outputSize, outputSize);
        } else {
            drawFallbackOverlay();
        }
    };

    const revokePhotoUrl = () => {
        if (state.photoUrl) {
            URL.revokeObjectURL(state.photoUrl);
            state.photoUrl = '';
        }
    };

    const resetFrame = () => {
        state.zoom = 1;
        state.offsetX = 0;
        state.offsetY = 0;

        if (zoomInput) {
            zoomInput.value = '1';
        }

        draw();
    };

    const loadImageFromUrl = (url) => {
        const image = new Image();

        image.onload = () => {
            revokePhotoUrl();
            state.photo = image;
            state.photoUrl = url;
            root.classList.add('has-photo');
            setEditingEnabled(true);
            resetFrame();
            setStatus('Foto carregada. Montagem pronta para baixar.');
        };

        image.onerror = () => {
            URL.revokeObjectURL(url);
            setStatus('Não foi possível carregar essa imagem.');
        };

        image.src = url;
    };

    const loadFile = (file) => {
        if (!file) {
            return;
        }

        if (!file.type.startsWith('image/')) {
            setStatus('Selecione um arquivo de imagem.');
            return;
        }

        loadImageFromUrl(URL.createObjectURL(file));
    };

    const stopCamera = () => {
        if (state.stream) {
            state.stream.getTracks().forEach((track) => track.stop());
            state.stream = null;
        }

        if (camera) {
            camera.pause();
            camera.srcObject = null;
            camera.hidden = true;
        }

        if (cameraActions) {
            cameraActions.hidden = true;
        }

        if (openCameraButton) {
            openCameraButton.disabled = false;
        }
    };

    const openCamera = async () => {
        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia || !camera) {
            setStatus('A câmera não está disponível neste navegador.');
            return;
        }

        try {
            state.stream = await navigator.mediaDevices.getUserMedia({
                audio: false,
                video: {
                    facingMode: 'user',
                    width: { ideal: 1080 },
                    height: { ideal: 1080 },
                },
            });

            camera.srcObject = state.stream;
            camera.hidden = false;

            if (cameraActions) {
                cameraActions.hidden = false;
            }

            if (openCameraButton) {
                openCameraButton.disabled = true;
            }

            await camera.play();
            setStatus('Câmera aberta.');
        } catch (error) {
            stopCamera();
            setStatus('Não foi possível acessar a câmera.');
        }
    };

    const capturePhoto = () => {
        if (!camera || !camera.videoWidth || !camera.videoHeight) {
            setStatus('A câmera ainda não está pronta.');
            return;
        }

        const snapshot = document.createElement('canvas');
        snapshot.width = camera.videoWidth;
        snapshot.height = camera.videoHeight;

        const snapshotCtx = snapshot.getContext('2d');
        snapshotCtx.drawImage(camera, 0, 0, snapshot.width, snapshot.height);

        snapshot.toBlob((blob) => {
            if (!blob) {
                setStatus('Não foi possível capturar a foto.');
                return;
            }

            loadImageFromUrl(URL.createObjectURL(blob));
            stopCamera();
        }, 'image/png');
    };

    const downloadAvatar = () => {
        if (!state.photo) {
            return;
        }

        draw();

        const fileName = config.fileName || 'foto-de-perfil.png';
        const downloadUrl = (url) => {
            const link = document.createElement('a');
            link.href = url;
            link.download = fileName;
            document.body.appendChild(link);
            link.click();
            link.remove();
        };

        if (!canvas.toBlob) {
            downloadUrl(canvas.toDataURL('image/png'));
            setStatus('Download iniciado.');
            return;
        }

        canvas.toBlob((blob) => {
            if (!blob) {
                setStatus('Não foi possível gerar o arquivo.');
                return;
            }

            const url = URL.createObjectURL(blob);
            downloadUrl(url);
            window.setTimeout(() => URL.revokeObjectURL(url), 5000);
            setStatus('Download iniciado.');
        }, 'image/png');
    };

    const getCanvasRatio = () => {
        const rect = canvas.getBoundingClientRect();
        return rect.width ? outputSize / rect.width : 1;
    };

    input?.addEventListener('change', () => {
        loadFile(input.files && input.files[0]);
        input.value = '';
    });

    zoomInput?.addEventListener('input', () => {
        state.zoom = Number(zoomInput.value) || 1;
        draw();
    });

    resetButton?.addEventListener('click', resetFrame);
    downloadButton?.addEventListener('click', downloadAvatar);
    openCameraButton?.addEventListener('click', openCamera);
    closeCameraButton?.addEventListener('click', stopCamera);
    captureButton?.addEventListener('click', capturePhoto);

    canvas.addEventListener('pointerdown', (event) => {
        if (!state.photo) {
            return;
        }

        state.isDragging = true;
        state.lastPointerX = event.clientX;
        state.lastPointerY = event.clientY;
        root.classList.add('is-dragging');
        canvas.setPointerCapture(event.pointerId);
        event.preventDefault();
    });

    canvas.addEventListener('pointermove', (event) => {
        if (!state.isDragging || !state.photo) {
            return;
        }

        const ratio = getCanvasRatio();
        state.offsetX += (event.clientX - state.lastPointerX) * ratio;
        state.offsetY += (event.clientY - state.lastPointerY) * ratio;
        state.lastPointerX = event.clientX;
        state.lastPointerY = event.clientY;
        draw();
    });

    const endDrag = (event) => {
        if (!state.isDragging) {
            return;
        }

        state.isDragging = false;
        root.classList.remove('is-dragging');

        if (canvas.hasPointerCapture(event.pointerId)) {
            canvas.releasePointerCapture(event.pointerId);
        }
    };

    canvas.addEventListener('pointerup', endDrag);
    canvas.addEventListener('pointercancel', endDrag);
    window.addEventListener('pagehide', () => {
        stopCamera();
        revokePhotoUrl();
    });

    overlay.onload = () => {
        state.overlayReady = true;
        draw();
    };

    overlay.onerror = () => {
        state.overlayFailed = true;
        draw();
    };

    if (config.overlayUrl) {
        overlay.src = config.overlayUrl;
    } else {
        state.overlayFailed = true;
    }

    setEditingEnabled(false);
    draw();
})();
