let table = $("#wrapper");

let loader = $("#table-loader").attr('loader');

let form = $('#entityForm');

let entity = $('#idEntity');

let table_label = {
    search: {
        placeholder: '🔍 Buscar...',
    },
    sort: {
        sortAsc: 'Orden de columna ascendente.',
        sortDesc: 'Orden de columna descendente.',
    },
    pagination: {
        previous: '⬅️',
        next: '➡️',
        navigate: (page, pages) => `Página ${page} de ${pages}`,
        page: (page) => `Página ${page}`,
        showing: 'Mostrando del',
        of: 'de',
        to: 'al',
        results: 'registros',
    },
    loading: 'Cargando...',
    noRecordsFound: 'No se encontraron resultados.',
    error: 'Ocurrió un error al cargar los datos.',
};

let table_pagination = {
    limit: 10,
    server: {
        url: (prev, page, limit) => `${prev}/${limit}/${page * limit}`
    }
}

let table_search = {
    server: {
        url: (prev, keyword) => `${prev}/${keyword}`
    }
};

function configTable(columns, server_data) {
    table.Grid({
        columns: columns,
        pagination: table_pagination,
        search: table_search,
        server: {
            url: loader,
            then: server_data,
            total: data => data.count
        },
        language: table_label
    });

    table.on('click', '.edit', function () {

        entity.val($(this).attr('entity'));
        form.attr('action', $('#editLink').val());
        form.trigger("submit")
    });
}

export {configTable};