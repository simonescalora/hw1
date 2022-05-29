function Checkout()
{
    alert ('Ordine effettuato con successo!');
}

const checkout = document.querySelector('#btn-checkout');
checkout.addEventListener('click', Checkout);

document.querySelectorAll('a[href^=".resoconto"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});



