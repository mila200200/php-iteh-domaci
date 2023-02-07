$('#dodajForm').submit(function () {
  event.preventDefault();
  console.log("Dodavanje");
  const $form = $(this);
  const $input = $form.find('input, select, button, textarea');

  const serijalizacija = $form.serialize();
  console.log(serijalizacija);

  $input.prop('disabled', true);

  req = $.ajax({
    url: 'handler/dodajVino.php',
    type: 'post',
    data: serijalizacija
  });

  req.done(function (res, textStatus, jqXHR) {
    if (res == "Ok") {
      alert("Vino je uspesno dodato");
      location.reload(true);
    } else console.log("Vino nije dodato " + res);
  });

  req.fail(function (jqXHR, textStatus, errorThrown) {
    console.error('Sledeca greska se desila: ' + textStatus, errorThrown)
  });
});



$('.btn-danger').click(function () {
  console.log("Brisanje");
  const trenutni = $(this).attr('data-id1');  //jQuery fja koja vraca vrednost prosledjenog atributa
  console.log('ID selektovanog vina za brisanje je: ' + trenutni);
  req = $.ajax({
    url: 'handler/obrisiVino.php',
    type: 'post',
    data: { 'id': trenutni }
  });

  req.done(function (res, textStatus, jqXHR) {
    if (res == "Ok") {
      $(this).closest('tr').remove();
      alert('Uspesno ste obrisali vino');
      location.reload(true);
      console.log('Obrisan');
    } else {
      console.log("KVino nije izbrisano " + res);
      alert("Vino nije izbrisano ");

    }
  });

});



$('#btn').click(function () {
  $('#pregled').toggle();
});

$('#btnDodaj').submit(function () {
  $('#myModal').modal('toggle');
  return false;
});

$('#btnIzmeni').submit(function () {
  $('#myModal').modal('toggle');
  return false;
});

//promena vrednosti cba
$("#tip").change(function(){
  var tipId =  $('#tip').val();
  $('#tipId').val(tipId);
  
});


//Edit
$('.btn-info').click(function () {

  const trenutni = $(this).attr('data-id2');
  console.log(trenutni);
  var nazivVina = $(this).closest('tr').children('td[data-target=nazivVina]').text();
  console.log(nazivVina);
  var kolicina = $(this).closest('tr').children('td[data-target=kolicina]').text();
  var cena = $(this).closest('tr').children('td[data-target=cena]').text();
  var tipId = $(this).closest('tr').children('td[data-target=tipId]').text();
  console.log(cena);
  console.log(tipId);
  


  $('#vinoId').val(trenutni);
  $('#nazivVina').val(nazivVina);
  $('#kolicina').val(kolicina);
  document.getElementById('tipOznaceni').value = tipId;
});



