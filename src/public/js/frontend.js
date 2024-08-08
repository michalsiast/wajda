
function submitForm(form, url = 'contact-form') {
    const formData = new FormData(form);

    let obj = {};
    for(const [name, value] of formData.entries()) {
        obj[name] = value;
    }

    fetch(BASE_URL + 'api/' + url,
        {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Lang': SITE_LANG,
            },
            body: JSON.stringify(obj)
        })
        .then(res => res.json())
        .then(res => {
            const alert = form.querySelector('#alert');
            alert.classList.remove('alert-success');
            document.querySelectorAll('form [name]').forEach(e => {
                e.classList.remove('is-invalid', 'is-valid');
                const invalidFb = e.closest('.form-group')?.querySelector('.invalid-feedback');
                if(invalidFb) {
                    invalidFb.classList.remove('d-block');
                    invalidFb.innerHTML = '';
                }
            })

            Object.keys(res.message).map(key => {
                const message = res.message[key];

                const field = document.querySelector(`[id="${key}"]`);
                const invalidFeedBackField = field?.closest('.form-group')?.querySelector('.invalid-feedback');

                if(res.status === 'error') {
                    field.classList.add('is-invalid');
                    if(invalidFeedBackField) {
                        invalidFeedBackField.classList.add('d-block');
                        invalidFeedBackField.innerHTML = message;
                    }
                }
                else if(res.status === 'success') {
                    document.querySelectorAll('form [name]').forEach(e => {
                        if(e.value) {
                            e.value = null;
                        }
                        if(e.checked) {
                            e.checked = false;
                        }
                    })


                    alert.classList.add('alert-success');
                    alert.innerHTML = res.message;
                }

            })

            // if(res.status === 'error') {
            //     Object.keys(res.message).map(key => {
            //         const message = res.message[key];
            //
            //         const field = document.querySelector(`[name="${key}"]`);
            //         field.classList.add('is-invalid');
            //         field.parentElement.querySelector('.invalid-feedback')?.innerHTML = message;
            //     })
            // }
            // else if(res.status === 'success') {
            //     Object.keys(res.message).map(key => {
            //         const field = document.querySelector(`[name="${key}"]`);
            //     })
            // }

            // if(res.status.toString() === 'error') {
            //     for(const [name, value] of formData.entries()) {
            //         const field = form.querySelector(`[name="${name}"]`);
            //         const errors = res.message[name];
            //
            //         if(errors?.length > 0) {
            //             field.classList.add('is-invalid');
            //             field.closest('.form-group').querySelector('.invalid-feedback').innerHTML = errors[0];
            //         }
            //         else {
            //             field.classList.remove('is-invalid');
            //         }
            //     }
            // }
            // else if(res.status.toString() === 'success') {
            //     for(const [name, value] of formData.entries()) {
            //         const field = form.querySelector(`[name="${name}"]`);
            //         field.classList.remove('is-invalid');
            //         field.value = '';
            //     }
            //
            //     alert.classList.add('alert-success');
            //     alert.innerHTML = res.message;
            // }
        })
}

AOS.init();
