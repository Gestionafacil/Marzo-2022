$("#formRegistro").submit(function (e) {
  e.preventDefault();
  Swal.fire({
    title: 'Do you want to save the changes?',
    showCancelButton: true,
    confirmButtonText: `Continuar`,
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../login/php/registro.php",
        { email: $('#email').val(), pass: $('#pass').val() },
        function (resp) {
          Swal.fire(resp, '', 'success');
        }
      );
    }
  })
});
