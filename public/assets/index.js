// function getCheckedValues() {
    
//     const checkboxes = document.querySelectorAll('input[name="options"]:checked');
//     const values = [];

//     checkboxes.forEach((checkbox) => {
//         const row = checkbox.closest('tr'); //  cherche la ligne sur laquelle se trouve la checkbox
//         const cells = row.querySelectorAll('td');
//         const rowData = {
//             checkboxValue: checkbox.value,
//             name: cells[1].innerText, // Assuming the second cell contains the name
//             value: cells[2].innerText  // Assuming the third cell contains the value
//         };
//         values.push(route('sales.store'));
//     });

//     // Display the result in the 'result' div
//     document.getElementById('result').innerText = JSON.stringify(values, null, 2);
// }