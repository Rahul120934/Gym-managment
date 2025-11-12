document.addEventListener('DOMContentLoaded', function() {
    const addTraineeForm = document.getElementById('add-trainee-form');
    const traineesTable = document.getElementById('trainees-table').getElementsByTagName('tbody')[0];

    // Fetch and display trainees
    function getTrainees() {
        fetch('php/api/trainees.php')
            .then(response => response.json())
            .then(data => {
                traineesTable.innerHTML = '';
                data.forEach(trainee => {
                    const row = traineesTable.insertRow();
                    row.innerHTML = `
                        <td>${trainee.Trainee_id}</td>
                        <td>${trainee.Name}</td>
                        <td>${trainee.Email}</td>
                        <td>${trainee.Gender}</td>
                        <td>${trainee.Training_Plan}</td>
                        <td>${trainee.Contact_number}</td>
                        <td>${trainee.Age}</td>
                        <td>${trainee.Height}</td>
                        <td>${trainee.Weight}</td>
                        <td>${trainee.Trainer_id}</td>
                    `;
                });
            });
    }

    // Add a new trainee
    addTraineeForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(addTraineeForm);
        const data = Object.fromEntries(formData.entries());

        fetch('php/api/trainees.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            console.log(result);
            getTrainees();
            addTraineeForm.reset();
        });
    });

    // Initial load
    getTrainees();
});
