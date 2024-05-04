fetch('buscar.php', {
    method: 'POST',
    body: JSON.stringify({ term: term }),
    headers: {
        'Content-Type': 'application/json'
    }
})
.then(response => response.json())
.then(data => {
    console.log(data);
})
.catch(error => {
    console.error('Error:', error);
});



