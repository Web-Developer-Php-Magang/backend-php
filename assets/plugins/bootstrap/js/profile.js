    // Menampilkan file dialog saat gambar profil diklik
    document.getElementById('image-preview').addEventListener('click', function () {
        document.getElementById('image').click();
    });

    // Menampilkan preview gambar saat memilih gambar baru
    document.getElementById('image').addEventListener('change', function () {
        const imagePreview = document.getElementById('image-preview');
        const file = this.files[0];
        const reader = new FileReader();

        reader.onload = function () {
            imagePreview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        var passwordInput = document.getElementById('password');
        var togglePasswordButton = document.getElementById('togglePassword');
    
        togglePasswordButton.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        var popup = document.querySelectorAll('._file_siswa');

        popup.forEach(function (link) {
            link.addEventListener('click', openNewWindow);
        })

        function openNewWindow(event) {
            event.preventDefault();
            var url = event.currentTarget.href;
            window.open(url, '_blank', 'width=800, height=600, resizable=yes, scrollbars=yes');
            return false;
        }
    })


    