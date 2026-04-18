function store(url, data) {
    axios.post(url, data)
        .then(function (response) {
            showMessage(response.data);
            clearForm();
            clearAndHideErrors();


            console.log(response.data);

        })

        .catch(function (error) {

            if (error.response.data.errors !== undefined) {
                showErrorMessages(error.response.data.errors);
            } else {
                showMessage(error.response.data);
            }
        });

}

function storepart(url, data) {

    axios.post(url, data)

        .then(function (response) {
            showMessage(response.data);
            clearForm();
            clearAndHideErrors();

        })

        .catch(function (error) {

            if (error.response.data.errors !== undefined) {
                showErrorMessages(error.response.data.errors);
            } else {

                showMessage(error.response.data);
            }
        });

}
function storeRoute(url, data) {
    axios.post(url, data, {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
})
        .then(function (response) {
             //showMessage(response.data);
            window.location = response.data.redirect ;
             showMessage(response.data);
             if (response.data.redirect) {
                window.location.href = response.data.redirect;
                return;
            }
             clearForm();
             clearAndHideErrors();
        })
        .catch(function (error) {

            if (error.response.data.errors !== undefined) {
                showErrorMessages(error.response.data.errors);
            } else {

                showMessage(error.response.data);
            }
        });
}
function storeRedirect (url, data, redirectUrl) {
    axios.post( url, data)
        .then(function (response) {
            console.log(response);
            if (redirectUrl != null)
                window.location.href = redirectUrl;
        })
        .catch(function (error) {
           // console.log(error.response);
           if (error.response.data.errors !== undefined) {
                showErrorMessages(error.response.data.errors);
            } else {

                showMessage(error.response.data);
            }
        });
}

function update (url, data, redirectUrl) {
    axios.put( url, data)

        .then(function (response) {
            console.log(response);

            if (redirectUrl != null)
                window.location.href = redirectUrl;
        })
        .catch(function (error) {
            console.log(error.response);
        });
}
function updateRoute (url, data) {
    axios.put( url, data)

        .then(function (response) {
            console.log(response);

        window.location = response.data.redirect;

        })
        .catch(function (error) {
            console.log(error.response);
        });
}
function updateReload (url, data, redirectUrl) {
    axios.put( url, data)
        .then(function (response) {
            console.log(response);
            location.reload()
        })
        .catch(function (error) {
            console.log(error.response);
        });
}
function updatePage(url, data) {
    axios.post(url, data)
        .then(function (response) {
            console.log(response);
            location.reload()
            // showMessage(response.data);
         })
        .catch(function (error) {
            console.log(error.response);
        });
}

function confirmDestroy(url, td) {
    Swal.fire({
        title: 'Are you sure you want to delete?',
        text: "You can't undo this action.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            destroy(url, td);
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Deleted successfully',
                showConfirmButton: false,
                timer: 2500
              })

        }else{

            Swal.fire({
                    icon: 'error',
                    title: 'Delete cancelled',
                    showConfirmButton: false,
                    timer: 2500

                  })
        }
    });
}


function destroy(url, td) {
    axios.delete(url)
        .then(function (response) {
            // handle success
            console.log(response.data);
            td.closest('tr').remove();
            // showToaster(response.data.message, true);
        })
        .catch(function (error) {
            // handle error
            console.log(error.response);
            // showToaster(error.response.data.message, false);
        })
        .then(function () {
            // always executed
        });
}




function showErrorMessages(errors) {

    document.getElementById('error_alert').hidden = false
    var errorMessagesUl = document.getElementById("error_messages_ul");
    errorMessagesUl.innerHTML = '';

    for (var key of Object.keys(errors)) {
        var newLI = document.createElement('li');
        newLI.appendChild(document.createTextNode(errors[key]));
        errorMessagesUl.appendChild(newLI);
    }
}

function clearAndHideErrors() {
    document.getElementById('error_alert').hidden = true
    var errorMessagesUl = document.getElementById("error_messages_ul");
    errorMessagesUl.innerHTML = '';
}

function clearForm() {
    document.getElementById("create_form").reset();
}

function showMessage(data) {
    console.log(data);
    Swal.fire({
        position: 'center',
        icon: data.icon,
        title: data.title,
        showConfirmButton: false,
        timer: 2500
    })
}


