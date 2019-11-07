
tickets=document.getElementsByClassName('ticket__offer');
rowSelectedElts=document.getElementsByClassName('')

tickets.forEach(function (ticket) {
        ticket.addEventListener('click',function  (e){console.log('j ai cliqué');

            divsCard=document.getElementsByClassName('ticket__offer__card');
            divsCard.forEach(function (div){

                div.style.display='none';

            });

        // delete the row seleceted by an other clic
        var rowSelecetedElts=document.getElementsByClassName('test__row--selected');
            rowSelecetedElts.forEach(function(row){
            row.classList.remove("test__row--selected");
        })

            // delete the offer activate by an other clic

        var offerActiveElts=document.getElementsByClassName('test__offer--active');
            offerActiveElts.forEach(function (offer) {
                offer.classList.remove('test__offer--active');

            })

        // add class test__row__selected at the row who offer was actived
        var rowOfferElt=e.target.closest(".row");
       rowOfferElt.classList.add('test__row--selected')

        // add class offer--active for check the offer was clic
        var offerActiveElt=e.target.closest('.ticket__offer__container');
        offerActiveElt.classList.add('test__offer--active');
        var cardElt=offerActiveElt.querySelector('.ticket__offer__card');
        cardElt.style.display='block';
    });


})

