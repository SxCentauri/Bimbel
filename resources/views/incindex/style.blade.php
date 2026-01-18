<style>
        body {
            background: #ccc;
            font-family: "Times New Roman", serif;
            margin: 0;
        }

        /* TOP BAR */
        .top-bar {
            background: #1f2937;
            color: #fff;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar h2 {
            margin: 0;
            font-size: 20px;
        }

        .top-bar button {
            background: #22c55e;
            border: none;
            padding: 6px 14px;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
        }

        /* A4 */
        .page {
            width: 210mm;
            min-height: 297mm;
            background: #fff;
            margin: 20px auto;
            padding: 25mm;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .soal {
            margin-bottom: 20px;
        }

        .opsi {
            margin-left: 20px;
        }

        @media print {
            .top-bar {
                display: none;
            }
            body {
                background: none;
            }
            .page {
                margin: 0;
                box-shadow: none;
            }
        }
            .top-bar {
        background: #1f2937;
        color: #fff;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        gap: 20px;
        }

        .top-bar h2 {
            margin: 0;
            font-size: 20px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #f6f6fd;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-link ion-icon {
            font-size: 18px;
        }

        .nav-link:hover {
            color: #22c55e;
        }

        .mapel {
            display: flex;
            gap: 15px;
            margin-left: auto; /* dorong mapel ke kanan */
        }

    /* RESET ISI HTML DARI DATABASE */
.isi-soal *,
.isi-opsi * {
    margin: 0 !important;
    padding: 0 !important;
}

/* SOAL */
.soal-row {
    display: grid;
    grid-template-columns: 30px 1fr;
    align-items: start;
    column-gap: 10px;
    margin-bottom: 12px;
    margin-top: 16px;
}

.opsi-text p {
    margin: 0;
    display: inline;
}
.no {
    font-weight: bold;
    text-align: right;
}

/* OPSI */
.opsi-row {
    display: grid;
    grid-template-columns: 30px 1fr;
    column-gap: 10px;
    row-gap: 10px;
    margin-top: 12px;
    padding-left: 30px; /* sejajar isi soal */
}

.huruf {
    font-weight: bold;
    text-align: right;
}


    </style>