import {html} from "gridjs";

$(document).ready(function () {

  $("div#wrapper").Grid({
    columns: ['Nombre', 'Limite de Credito', 'País', 'Acciones'],
    pagination: {
      limit: 10,
      server: {
        url: (prev, page, limit) => `${prev}/${limit}/${page * limit}`
      }
    },
    search: {
      server: {
        url: (prev, keyword) => `${prev}/${keyword}`
      }
    },
    server: {
      url: $('#table-loader').attr('loader'),
      then: data => data.results.map(cliente => [
        cliente.name, cliente.limite, cliente.pais, html(cliente.edit)
      ]),
      total: data => data.count
    }
  });

  $("#wrapper").on('click', '.edit-cliente', function () {

    let form = $('#clienteForm');
    $('#idCliente').val($(this).attr('cliente'));
    form.attr('action', $('#editLink').val());
    form.submit();
  });
});
