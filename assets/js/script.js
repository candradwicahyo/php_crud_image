/*
  nama : candra dwi cahyo
  umur : 16 tahun
  email : candradwicahyo18@gmail.com
*/

const badgesHapus = document.querySelectorAll('.badges-hapus');
badgesHapus.forEach(badge => {
  badge.addEventListener('click', function(event) {
    
    //berfungsi untuk menghentikan fungsi dari attribute href
    event.preventDefault();
    
    //tujuan utama
    const target = this.dataset.target;
    
    swal.fire({
      position: 'center',
      icon: 'warning',
      title: 'apakah sudah yakin',
      text: 'ingin menghapus data tersebut',
      showCancelButton: true,
      cancelButtonText: 'tidak',
      confirmButtonText: 'iya'
    }).then(result => {
      if (result.value) {
        document.location.href = target;
      } else {
        swal.fire({
          position: 'center',
          icon: 'error',
          text: 'hapus data dibatalkan',
          confirmButtonColor: 'red'
        });
      }
    })
    
  });
});
