

$(() => {


    document.querySelectorAll('.ckeditorStandard').forEach(e => {
        ClassicEditor
            .create( e, {
                language: 'pl',
            } )
            .catch( error => {
                console.error( error );
            } );
    })


    document.querySelectorAll('button.nav-link').forEach(el => {
        el.addEventListener('click', e => {
            document.querySelectorAll('.nav.-active').forEach(navEl => {
                if(navEl !== e.target.nextElementSibling) {
                    navEl.classList.remove('-active');
                }
            })
            e.target.nextElementSibling.classList.toggle('-active');
        })
    })


    $('.sortable tbody').sortable({
        update: (event, ui) => {
            const table = ui.item.closest('.sortable');
            let items = [];

            const tableTrs = table.find('tbody tr');
            tableTrs.map((index, row) => {
                items.push({
                    id: row.getAttribute('data-id'),
                    position: table.data('order') === 'asc' ? index : tableTrs.length-1 - index,
                })
            })


            fetch(baseUrl + 'change-order/' + table.data('table'),
                {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({items})
                })
            .then(res => {
                table.find('tbody tr').map((index, row) => {
                    row.querySelector('td[data-position]').innerHTML = index+1;
                });
            })
        }
    });


    $('.-sortable').sortable({
        update: (event, ui) => {
            const parent = ui.item.closest('.-sortable');
            let items = [];

            const parentItems = parent.find('.navItem__parent');
            parentItems.map((index, row) => {
                items.push({
                    id: row.getAttribute('data-id'),
                    position: parent.data('order') === 'asc' ? index : parentItems.length-1 - index,
                })
            })

            fetch(baseUrl + 'change-order/' + parent.data('table'),
                {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({items})
                })
                .then(res => {
                    parent.find('tbody tr').map((index, row) => {
                        row.querySelector('td[data-position]').innerHTML = index+1;
                    });
                })
        }
    });
})


function slugify (str) {
    const from  = "ąàáäâãåæćęęèéëêìíïîłńòóöôõøśùúüûñçżź",
        to    = "aaaaaaaaceeeeeeiiiilnoooooosuuuunczz",
        regex = new RegExp('[' + from.replace(/([.*+?^=!:${}()|[\]\/\\])/g, '\\$1') + ']', 'g');

    if (str === null) return '';

    str = String(str).toLowerCase().replace(regex, function(c) {
        return to.charAt(from.indexOf(c)) || '-';
    });

    return str.replace(/[^\w\s-]/g, '').replace(/([A-Z])/g, '-$1').replace(/[-_\s]+/g, '-').toLowerCase();
}

const searchForm = document.querySelector('#searchCategory select');
if(searchForm){
    document.querySelector('#searchCategory select').addEventListener('change', (e) => {
        document.getElementById('searchCategory').submit();
    })
}

$('.status-switch').change(function(){
    $('.status-switch').attr('disabled','disabled');

    console.log(baseUrl)
    $.post(baseUrl + 'setstatus', {'model':$(this).data('source_table'), 'source_id':$(this).data('source_id') , '_token': csrfToken , 'value':$(this).prop('checked')?1:0 }, function(result){
        $('.status-switch').prop('disabled',false);
        toastr.options.positionClass = "toast-bottom-right";
        toastr.success('Pomyślnie zmieniono status.')
    });
});
