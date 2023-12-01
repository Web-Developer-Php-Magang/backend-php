var page = 1;
var loading = false;
var finished = false;

$(document).ready(function () {
    loadMagang(page);

    $(window).scroll(function () {
        if (!finished && !loading && shouldLoadMore()) {
            page++;
            loadMagang(page);
        }
    });

    $("#magang-container").on("click", ".submit-request-button", function () {
        const magangId = $(this).data("magang-id");
        submitMagangRequest(magangId);
    });
});

function shouldLoadMore() {
    return !finished && !loading && $(window).scrollTop() + $(window).height() >= $("#magang-container").height() - 100;
}

function loadMagang(page) {
    if (loading || finished) {
        return;
    }

    loading = true;
    var currentURL = buildUrl(page);
    $("#loading").show();

    setTimeout(function () {
        $.ajax({
            url: currentURL,
            method: "GET",
            success: function (data) {
                if (data.success) {
                    if (data.magang.length === 0) {
                        finished = true;
                    } else {
                        appendMagangToContainer(data.magang);
                    }
                } else {
                    console.error(data.message);
                }

                loading = false;
                $("#loading").hide();

                if (!data.hasNextPage) {
                    finished = true;
                }
            },
            error: function () {
                finished = true;
                loading = false;
                $("#loading").hide();
            }
        });
    }, 3000);
}

function appendMagangToContainer(magang) {
    magang.forEach(function (magangItem) {
        let button = '';

        if (magangItem.status === "1") {
            button = `<button class="btn btn-danger w-100" disabled>Kuota telah penuh</button>`;
        } else if (magangItem.request_status === 'pending') {
            button = `<button class="btn btn-warning w-100" disabled>Permintaan telah dikirim</button>`;
        } else if (magangItem.request_status === "") {
            button = `<button type="button" class="btn btn-primary w-100 submit-request-button" data-magang-id="${magangItem.id}">Kirim permintaan</button>`;
        }

        const cardHtml = `
            <div class="col-md-6 mb-4">
                <div class="card">
                    <h5 class="card-header">${magangItem.name}</h5>
                    <div class="text-center">
                        <img class="card-img-top setup-img" src="${magangItem.image}" alt="${magangItem.name}">
                    </div>
                    <div class="card-body">
                        <p class="card-text setup-text">${magangItem.description}</p>
                        <div class="row">
                            <div class="col-md-8">
                                ${button}
                            </div>
                            <div class="col-md-4 text-center d-flex justify-content-end align-items-center">
                                <span class="me-2">${magangItem.lecture}</span>
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;

        $("#magang-container").append(cardHtml);
    });
}

function buildUrl(page) {
    // merubah nilai menjadi array berdasarkan '/'
    const pathArray = window.location.href.split('/');
    // ambil indeks terakhir
    const lastPart = pathArray[pathArray.length - 1];
    // jika indeks terakhir kosong
    if (lastPart === "") {
        // indeks terakhir jadikan home
        pathArray[pathArray.length - 1] = "home";
    }
    // ternary condition 
    const url = (page === 1) ? pathArray.join('/') + '/json' : pathArray.join('/') + '/json/' + page;
    return url;
}

function submitMagangRequest(magangId) {
    const formData = new FormData();
    formData.append('magang_id', magangId);

    $.ajax({
        url: window.location.origin + '/kelompok_5/magang/store',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            // Mengganti teks pesan toast dengan data.message dari respons
            const toast = $(".toast");
            const toastBody = toast.find(".toast-body");
            toastBody.text(data.message);

            // Mengganti warna latar belakang toast berdasarkan pesan
            const toastBg = data.message === 'Permintaan berhasil dikirim' ? 'bg-success' : 'bg-danger';
            toast.removeClass('bg-success bg-danger').addClass(toastBg);

            // Mengubah button berdasarkan atribut magang-id
            const button = $(`button[data-magang-id="${magangId}`);
            if (data.message === 'Permintaan berhasil dikirim') {
                button.replaceWith('<button class="btn btn-warning w-100" disabled>Permintaan telah dikirim</button>');
            }

            // Menampilkan toast
            toast.toast('show');
        },
        error: function () {
            console.error("Gagal mengirim permintaan");
        }
    });
}












// $(window).scroll(function () {
//     var scrollTop = $(window).scrollTop();
//     var windowHeight = $(window).height();
//     var containerHeight = $("#magang-container").height();

//     console.log("scroll: ", scrollTop, ">=", containerHeight - windowHeight);
// });