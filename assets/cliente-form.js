//JS
import 'jquery-validation';
import './scripts/phoneMX';
import './scripts/messages_es';
//CSS
import './styles/forms.css'

$(document).ready(function () {

    let form=$("#entry");
    let telephone=$("#cliente_form_telefono");
    form.validate({
        errorElement: "span"
    });
    telephone.rules('add', {
        phoneMX: true
    });
});