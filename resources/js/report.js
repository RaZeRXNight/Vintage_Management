
if (document.getElementById('Report_Container')) {
    // Getting Report Container
    // This is the main container for the report section.
    const reportContainer = document.getElementById('Report_Container');
    const reportTable = document.getElementById('Report_Table');   
    
    
    // Getting Report Buttons
    const reportButtons = document.getElementById('Report_Buttons');

    //Getting Date Inputs
    const Start_Date = document.getElementById('Start_Date');
    const End_Date = document.getElementById('End_Date');
    const Search = document.getElementById('Search');

    // Let Variables
    let Current_Type = null;
    let S_Date;
    let E_Date

    // Giving Buttons Functionality
    reportButtons.querySelectorAll('button').forEach(btn =>
        btn.addEventListener('click', function(event) {
        console.log(event.target.dataset.type)
            Current_Type = event.target.dataset.type;
            
        })
    );

    // Giving Search Bar Functionality
    Search.addEventListener('keyup', function(event) {
        console.log(event.target.value)

        updateTable()
    });

    // Giving Start/End Date Functionality
    Start_Date.addEventListener('change', function(event) {
        console.log(event.target.value)
        updateTable()
    })

    End_Date.addEventListener('change', function(event) {
        console.log(event.target.value)
        updateTable()
    })

    function updateTable() {
        // Validating Data
        
        // Getting Report Filters
        if (Start_Date) { S_Date = new Date(Start_Date.value) }
        if (End_Date) { E_Date = new Date(End_Date.value) }


        console.log('The User is Searching for ' + Search.value + ' in ' + Current_Type + ' Ranging From ' + S_Date + ' to ' + E_Date);

        // Checking for Type of Report for Header Accuracy.
        if (Current_Type === 'Products') {


        } else if (Current_Type === 'Sales') {

            
        }
    }

}