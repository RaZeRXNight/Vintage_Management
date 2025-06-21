import { renderPaginationControls } from './pagination.js';

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
    let Current_Type = 'Products';
    let Sort;
    let S_Date;
    let E_Date;

    // Pagination Variables
    const itemsperpage = 10;
    let page = 1;

    // Giving Buttons Functionality
    reportButtons.querySelectorAll('button').forEach(btn =>
        btn.addEventListener('click', function(event) {
            Sort = btn.id;
            if (event.target.dataset.type) {
                Current_Type = event.target.dataset.type;
            }
            console.log(Current_Type);
            
            updateTable()
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
        Sort = null;
        updateTable()
    })

    End_Date.addEventListener('change', function(event) {
        console.log(event.target.value)
        Sort = null;
        updateTable()
    })

    function Sort_Date() {
        // Helper to pad numbers to 2 digits
        const now = new Date();
        const pad = n => n.toString().padStart(2, '0');

        if (Sort === 'Today') {
            // Format as 'YYYY-MM-DDTHH:MM'
            now.setHours(0, 0, 0, 0)
            const formatted_S = 
                now.getFullYear() + '-' +
                pad(now.getMonth() + 1) + '-' +
                pad(now.getDate()) + 'T' +
                pad(now.getHours()) + ':' +
                pad(now.getMinutes());
            Start_Date.value = formatted_S;

            now.setHours(23, 59, 59, 0)
            const formatted_E = 
                now.getFullYear() + '-' +
                pad(now.getMonth() + 1) + '-' +
                pad(now.getDate()) + 'T' +
                pad(now.getHours()) + ':' +
                pad(now.getMinutes());
            End_Date.value = formatted_E;
        } else if (Sort === 'Week') {
            // Format as 'YYYY-MM-DDTHH:MM'
            while (now.getDay() != 1) {
                now.setDate(now.getDate()-1);
            }
            now.setHours(0, 0, 0, 0)
            const formatted_S = 
                now.getFullYear() + '-' +
                pad(now.getMonth() + 1) + '-' +
                pad(now.getDate()) + 'T' +
                pad(now.getHours()) + ':' +
                pad(now.getMinutes());
            Start_Date.value = formatted_S;

            while (now.getDay() != 6) {
                now.setDate(now.getDate()+1);
            }
            now.setHours(23, 59, 59, 0)
            const formatted_E = 
                now.getFullYear() + '-' +
                pad(now.getMonth() + 1) + '-' +
                pad(now.getDate()) + 'T' +
                pad(now.getHours()) + ':' +
                pad(now.getMinutes());
            End_Date.value = formatted_E;

        } else if (Sort === 'Month') {
            // Format as 'YYYY-MM-DDTHH:MM'
            now.setDate(0);  now.setHours(0, 0, 0, 0);
            const formatted_S = 
                now.getFullYear() + '-' +
                pad(now.getMonth() + 1) + '-' +
                pad(now.getDate()) + 'T' +
                pad(now.getHours()) + ':' +
                pad(now.getMinutes());
            Start_Date.value = formatted_S;

            now.setMonth(now.getMonth()+1); now.setDate(0); now.setHours(23, 59, 59, 0)
            const formatted_E = 
                now.getFullYear() + '-' +
                pad(now.getMonth() + 1) + '-' +
                pad(now.getDate()) + 'T' +
                pad(now.getHours()) + ':' +
                pad(now.getMinutes());
            End_Date.value = formatted_E;

        } else if (Sort === 'Year') {
            // Format as 'YYYY-MM-DDTHH:MM'
            now.setMonth(now.setMonth(0))
            const formatted_S = 
                now.getFullYear() + '-' +
                pad(now.getMonth() + 1) + '-' +
                pad(now.getDate()) + 'T' +
                pad(now.getHours()) + ':' +
                pad(now.getMinutes());
            Start_Date.value = formatted_S;

            now.setMonth(12)
            const formatted_E = 
                now.getFullYear() + '-' +
                pad(now.getMonth() + 1) + '-' +
                pad(now.getDate()) + 'T' +
                pad(now.getHours()) + ':' +
                pad(now.getMinutes());
            End_Date.value = formatted_E;

        }
    }

    function Sortie(Table) {
        let Sort_Filter;
        
        if (Current_Type === 'Products' ) {
            Sort_Filter = Table
            console.log(Sort);
            // Sort In Order By Button
            if (Sort === 'Most_Sold') {
                console.log('Sorting Most Sold Products')
                Sort_Filter = Sort_Filter.sort(function(a, b){return a.Quantity - b.Quantity})
            } else if (Sort === 'Least_Sold') {
                console.log('Sorting Least Sold Products')
                Sort_Filter = Sort_Filter.sort(function(a, b){return b.Quantity - a.Quantity})
            }
            return Sort_Filter;
        } else if (Current_Type === 'Sales') {
            Sort_Filter = Table
            console.log(Sort);

            return Sort_Filter;
        } else {
            return false;
        }
    }

    function Filter() {
        const Product_Data = JSON.parse(document.getElementById('products-data').value);
        const Transaction_Data = JSON.parse(document.getElementById('transactions-data').value);
        const Sales_Data = JSON.parse(document.getElementById('sales-data').value);
        let Filtered = null;

        if (Current_Type === 'Products') {    
            // Filtering by Search
            Filtered = Product_Data.filter(p=>
                p.ProductName.toLowerCase().includes(Search.value.toLowerCase())
            );

            // Filters Through Each Product Item
            Filtered.forEach(item => {
                // Filters Through Each Sale
                // Identifies Sales with the same ProductID and adds to a Total.
                item.Quantity = 0;
                let Total = 0;

                let Product_Sales_Data = Sales_Data.filter(item => {
                    let item_Date = new Date(item.created_at) 
                    const validStart = S_Date instanceof Date && !isNaN(S_Date);
                    const validEnd = E_Date instanceof Date && !isNaN(E_Date);
                    
                    if (validStart && validEnd) {
                        return (item_Date >= S_Date
                        && item_Date <= E_Date) 
                        || (S_Date.toDateString() === item_Date.toDateString() 
                            && E_Date.toDateString() === item_Date.toDateString()) ;
                    };
                    return true;
                })

                Product_Sales_Data.forEach(sale => {
                    if (sale.ProductID === item.id ) { Total += sale.Quantity; }
                });
                item.Quantity = Total;
            });
        };
        if (Current_Type === 'Sales') {    
            // Filtering by Search  
            // Filtering through each sale using the search bar for product name.
            Filtered = Sales_Data.filter(s => {
                return Product_Data.some(p => {
                    s.ProductName = p.ProductName;
                    return s.ProductID === p.id && 
                    p.ProductName.toLowerCase().includes(Search.value.toLowerCase());
                })
            })

            Filtered = Filtered.filter(item => {
                let item_Date = new Date(item.created_at) 
                const validStart = S_Date instanceof Date && !isNaN(S_Date);
                const validEnd = E_Date instanceof Date && !isNaN(E_Date);
                
                if (validStart && validEnd) {
                    return (item_Date >= S_Date
                    && item_Date <= E_Date) 
                    || (S_Date.toDateString() === item_Date.toDateString() 
                        && E_Date.toDateString() === item_Date.toDateString()) ;
                };
                return true;
            })
        };

        console.log('Producing Table ' + Filtered);

        return Filtered;
    }

    function renderPagination(filteredData, itemsperpage, currentPage, onPageChange) {
        // Remove existing pagination if present
        const oldPagination = document.getElementById('pagination');
        if (oldPagination) oldPagination.remove();

        const totalPages = Math.ceil(filteredData.length / itemsperpage);
        if (totalPages <= 1) return; // No need for pagination

        const paginationDiv = document.createElement('div');
        paginationDiv.id = 'pagination';
        paginationDiv.className = 'flex flex-row max-w-fit';
        paginationDiv.style.textAlign = 'center';

        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.textContent = i;
            btn.style.margin = '0 4px';
            btn.disabled = i === currentPage;
            btn.onclick = () => {
                page = i;
                console.log(page + ' is the Current page.');
                updateTable()
            }
            paginationDiv.appendChild(btn);
        }

        // Insert after the report table
        reportTable.appendChild(paginationDiv);
    }

    function renderTablePage(filteredData, page) {
        // Render only the rows for the current page
        const start = (page - 1) * itemsperpage;
        const end = start + itemsperpage;
        const pageData = filteredData.slice(start, end);

        // ...your code to render table rows using pageData...
        const Tbody = document.createElement('tbody');
        let Total = 0;

        // Adding Table Details...
        if (Current_Type === 'Products') {
            pageData.forEach(item => {
                const Trow = document.createElement('tr');
                Trow.innerHTML = `
                <td>${item.id}</td>
                <td>${item.CategoryID}
                <td>${item.ProductName}</td>
                <td>${item.UnitsInStock}</td>
                <td>${item.Quantity}</td>
                `
                
                console.log(item.ProductName);
                Tbody.appendChild(Trow);
            });
        } else if (Current_Type === 'Sales') {
            pageData.forEach(item => {
                const Trow = document.createElement('tr');
                Trow.innerHTML = `
                <td><a href='/sale_management/view_transaction/${item.TransactionID}'>${item.TransactionID}</a></td>
                <td>${item.id}</td>
                <td>${item.ProductName}</td>
                <td>${item.Quantity}</td>
                <td>${item.TotalPrice}</td>
                <td>${new Date(item.created_at).toDateString()}</td>
                `
                Total+=Number(item.TotalPrice);
                Tbody.appendChild(Trow);
            });

            const Table_Footer = document.createElement('tfoot');
            Table_Footer.className = 'flex flex-row justify-center'
            Table_Footer.innerHTML = `<tr><td>Total:</td><td>${Total.toFixed(2)}</td></tr>`
            Tbody.appendChild(Table_Footer);
        }

        reportTable.appendChild(Tbody);

        renderPagination(filteredData, itemsperpage, page, (newPage) => {
            currentPage = newPage;
            renderTablePage(filteredData, newPage);
        });
    }

    function updateTable() {
        Sort_Date()

        // Getting Report Filters
        if (Start_Date) { S_Date = new Date(Start_Date.value) }
        if (End_Date) { E_Date = new Date(End_Date.value) }

        console.log('The User is Searching for ' + Search.value + ' in ' + Current_Type + ' Ranging From ' + S_Date + ' to ' + E_Date);

        reportTable.innerHTML = ``;
        // Checking for Type of Report for Header Accuracy.
        if (Current_Type === 'Products') {
            const Theader = document.createElement('thead');
            Theader.innerHTML = `<tr>
                <th>ID</th>
                <th>Category</th>
                <th>Name</th>
                <th># In Stock</th>
                <th># Sold</th>
            </tr>`;
            reportTable.appendChild(Theader);
        } else if (Current_Type === 'Sales') {
            const Theader = document.createElement('thead');
            Theader.innerHTML = `<tr>
                <th>Trans ID</th>
                <th>ID</th>
                <th>Name</th>
                <th># Sold</th>
                <th>Total Price</th>
                <th>Time</th>
            </tr>`;
            reportTable.appendChild(Theader);
        }

        // Set Up Pagination Properties
        let Filtered = Sortie(Filter());
        const totalProducts = Filtered.length;
        const totalPages = Math.ceil(totalProducts / itemsperpage);
        page = Math.max(1, Math.min(page, totalPages));

        renderTablePage(Filtered, page);

        renderPagination(Filtered, itemsperpage, page)
    }
}