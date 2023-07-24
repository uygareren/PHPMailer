// Function to clear the form fields
function clearFormFields() {
    document.getElementById('receiverEmail').value = '';
    document.getElementById('senderEmail').value = '';
    document.getElementById('topicEmail').value = '';
    document.getElementById('message').value = '';
    document.getElementById('formFileLg').value = '';
}

// Attach an event listener to the delete button
document.getElementById('deleteButton').addEventListener('click', function() {
    clearFormFields();
});