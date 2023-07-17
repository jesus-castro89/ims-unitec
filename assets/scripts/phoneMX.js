$.validator.addMethod( "phoneMX", function( phone_number, element ) {
    phone_number = phone_number.replace( /\s+/g, "" );
    return this.optional( element ) || phone_number.length > 9 &&
        phone_number.match( /^(\+\d{1,2}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/ );
}, "El número de teléfono debe ser a 10 posiciones y únicmaente digitos." );