

const delForm = document.querySelectorAll('.delete-apartment-form');

delForm.forEach(form => {

    form.addEventListener('submit', function(e){

        const resp = confirm('Sei sicuro di volerlo cancellare?');
        if(!resp){
            e.preventDefault();
        }
    })
});
