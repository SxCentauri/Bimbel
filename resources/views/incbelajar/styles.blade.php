 <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    .popup-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.popup-box {
    background: #fff;
    padding: 24px 32px;
    border-radius: 14px;
    text-align: center;
    min-width: 280px;
    animation: scaleIn 0.35s ease;
    box-shadow: 0 20px 40px rgba(0,0,0,0.25);
}

.popup-box i {
    font-size: 40px;
    color: #22c55e;
    margin-bottom: 10px;
}

.popup-box p {
    font-size: 15px;
    font-weight: 500;
    color: #333;
}



@keyframes scaleIn {
    from {
        transform: scale(0.85);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
    
}

/* ===============================
   FORM AKUN GURU (KHUSUS)
================================ */

.guru-form-wrapper {
    padding: 20px;
}

.guru-card {
    background: #fff;
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
    max-width: 600px;
}

.guru-card-header {
    margin-bottom: 20px;
}

.guru-card-header h2 {
    font-weight: 600;
    color: var(--blue);
}

/* FORM */
.guru-form {
    display: grid;
    grid-template-columns: 1fr;
    gap: 15px;
}

/* GROUP */
.guru-form-group {
    display: flex;
    flex-direction: column;
}

.guru-form-group label {
    font-weight: 600;
    margin-bottom: 6px;
}

.guru-form-group input {
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 14px;
}

/* BUTTON */
.guru-button-group {
    display: flex;
    gap: 12px;
    margin-top: 10px;
}

.guru-btn-save {
    background: #2a2185;
    color: #fff;
    padding: 10px 22px;
    font-weight: 600;
    border-radius: 8px;
    border: none;
    cursor: pointer;
}

.guru-btn-save:hover {
    background: #1f1964;
}

.guru-btn-cancel {
    background: #ccc;
    color: #000;
    padding: 10px 22px;
    font-weight: 600;
    border-radius: 8px;
    text-decoration: none;
}

.guru-btn-cancel:hover {
    background: #b3b3b3;
}

.ck-content .image-inline img {
    max-width: 300px;
    height: auto;
}



</style>