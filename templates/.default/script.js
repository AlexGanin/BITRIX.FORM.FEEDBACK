$(document).ready(function() {

    document.querySelector('#link-write-us').addEventListener('click', () => {
        $("#staticBackdrop").modal('show');
    });





    const myForms = () => {

        const forms = document.querySelectorAll('.form_feedback'),
            //fields = forms.querySelectorAll('input, textarea'),
            requestURL = '/bitrix/components/webcoder/form.feedback/form.php',
            data = {},
            isCheckboxOrRadio = type => ['checkbox','radio'].includes(type),
            clearInputs = () => {fields.forEach(field => {
                if( field.classList.contains('checkit') || field.type === 'file' ) {
                    field.value = '';
                };
            });
        };
        let stopSend = false;

        function checkInputs() {

            fields.forEach((field, key, array) => {

                const {value,checked,type,name} = field;

                if(field.classList.contains('checkit')) {
                
                    if(field.type === 'checkbox') {

                        if(field.checked !== true) {
                            field.parentElement.querySelector('label').classList.add('text-danger');
                            //fieldStatus = false;
                        } else {
                            field.parentElement.querySelector('label').classList.remove('text-danger');
                        }
                        
                    }

                    if(field.type === 'text' || field.type === 'textarea') {
                        if(field.value == '') {
                            field.classList.add('is-invalid');
                            //fieldStatus = false;
                        } else {
                            field.classList.remove('is-invalid');
                        }
                    }
                }

                data[name] = isCheckboxOrRadio(type) ? checked : value;

                if(data[name] == false) {stopSend = true;}

            });
        }




        const sendRequest = (method, url, body = null) => {

            return new Promise((resolve, reject) => {

                //document.querySelector('.status').textContent = message.loading;
                const xhr = new XMLHttpRequest();

                xhr.open(method, url);

                console.log('!##################!');
                console.log(body);

                //xhr.responseType = 'json'
                //xhr.setRequestHeader('Content-Type', 'application/json');

                xhr.onload = () => {
                    if(xhr.status >= 400) {
                        reject(xhr.response);
                    } else {
                        resolve(xhr.response);
                    }
                }

                xhr.onerror = () => {
                    reject(xhr.response)
                }

                xhr.send(JSON.stringify(body));

            })
        }


        forms.forEach( form => {

            form.addEventListener('submit', (e) => {

                fields = form.querySelectorAll('input, textarea'),

                e.preventDefault();

                //.setAttribute('style','border: 1px solid red');

                const captcha = new Promise( function(resolve,reject) {
                    grecaptcha.ready(function() {
                        grecaptcha.execute('6LdO2vwZAAAAAGeOeQVIzEK4L_bBmoOvkhYEbrmH', {action: 'homepage'}).then(
                            function(token) {
                                form.querySelector('.token').value = token;
                                resolve();
                            });
                    })
                });

                captcha.then(()=>{

                    stopSend = false;

                    checkInputs();

                    if(stopSend) return false;


                    let statusMessage = document.createElement('div');
                    statusMessage.classList.add('status', 'alert', 'alert-warning', 'mt-2');
                    statusMessage.textContent = 'Загрузка...';
                    form.querySelector('p:nth-child(2)').appendChild(statusMessage);

                    sendRequest('POST', requestURL, data)
                    .then(data => {
                        clearInputs();
                        
                        statusMessage.textContent = data;
                        setTimeout(()=> {
                            statusMessage.remove();
                        }, 10000);

                    }).catch(err => console.log(err))

                })
            });

        });
        
    };

    myForms();

});



// sendRequest(formAction, formData)
// .then(res => {
//     console.log(res);
//     statusMessage.textContent = message.success;
// })
// .catch( () => statusMessage.textContent = message.failure )
// .finally( () => {
//     clearInputs();
//     // setTimeout( () => {
//     //     statusMessage.remove();
//     // }, 5000);
// })




//inputs.setAttribute('style','border: 1px solid red');

// const postData = async (url, data) => {
//     document.querySelector('.status').textContent = message.loading;
//     let res = await fetch(url, {
//         method: "POST",
//         body: data
//     });

//     return await res.text();
// }