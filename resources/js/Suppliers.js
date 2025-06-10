import { renderPaginationControls } from './pagination.js';


document.addEventListener('DOMContentLoaded', () => {
    // Initialize product management functionality here
    const supplier_management = document.getElementById('supplier-management');
    let category = 0;
    let search = null;
    let currentPage = 1;

    const suppliers = document.querySelector('#suppliers-items');

    if (!suppliers) {
        return;
    }

    const suppliersData = JSON.parse(document.getElementById('suppliers-data').value);

    UpdateSupplierList(search, currentPage);

    function UpdateSupplierList(search, currentPage) {
        // Setting Current Filter
        let Filtered = null;
        let count = 0;
        const suppliersperpage = 10;

        // Clear the suppliers list
        suppliers.innerHTML = '';

        // Filter suppliers based on category and search query

        if (search === null || search === '') { 
            Filtered = suppliersData; 
            console.log('Loaded All');
        } 
        else if (search) {
            Filtered = suppliersData.filter(supplier =>
                supplier.SupplierName.toLowerCase().includes(search.toLowerCase())
            );
        }

        // Paginate the filtered results
        // Set Up Pagination Properties
        const totalSuppliers = Filtered.length;
        const totalPages = Math.ceil(totalSuppliers / suppliersperpage);
        currentPage = Math.max(1, Math.min(currentPage, totalPages));

        const start = (currentPage - 1) * suppliersperpage;
        const end = start + suppliersperpage;
        const paginated = Filtered.slice(start, end);

        // Render the filtered and paginated suppliers
        paginated.forEach(supplier => {
            const supplierItem = document.createElement('tr');
            supplierItem.className = 'supplier-item';
            supplierItem.innerHTML = `
                <td>${supplier.id}</td>
                <td>${supplier.SupplierName}</td>
                <td>${supplier.ContactName}</td>
                <td>${supplier.ContactEmail}</td>
                <td>${supplier.Phone}</td>
            `;
            suppliers.appendChild(supplierItem);
            count++;
        });

        renderPaginationControls(suppliers, totalPages, currentPage, 0, search, UpdateSupplierList);

        console.log(count + ' Suppliers Found.');
        return true;
    }

    let searchbar = supplier_management ? supplier_management : document;
    searchbar.querySelector('#Search').addEventListener('keyup', function(event) {
        // Get Text Content from Text Field.
        search = this.value;

        console.log(search + ' Added to Search.');

        // Send Request.
        UpdateSupplierList(search, currentPage);
    })

    
});