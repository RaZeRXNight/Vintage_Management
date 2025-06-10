import { renderPaginationControls } from './pagination.js';


document.addEventListener('DOMContentLoaded', () => {
    // Initialize product management functionality here
    const order_management = document.getElementById('order-management');
    let category = 0;
    let search = null;
    let currentPage = 1;

    const orders = document.querySelector('#orders-items');
    if (!orders) { return; }

    const ordersData = JSON.parse(document.getElementById('orders-data').value);

    UpdateOrderList(search, currentPage);

    function UpdateOrderList(search, currentPage) {
        // Setting Current Filter
        let Filtered = null;
        let count = 0;
        const ordersperpage = 10;

        // Clear the orders list
        orders.innerHTML = '';

        // Filter orders based on category and search query

        if (search === null || search === '') { 
            Filtered = ordersData; 
            console.log('Loaded All');
        } 
        else if (search) {
            Filtered = ordersData.filter(order =>
                order.productName.toLowerCase().includes(search.toLowerCase())
            );
        }

        // Paginate the filtered results
        // Set Up Pagination Properties
        const totalOrders = Filtered.length;
        const totalPages = Math.ceil(totalOrders / ordersperpage);
        currentPage = Math.max(1, Math.min(currentPage, totalPages));

        const start = (currentPage - 1) * ordersperpage;
        const end = start + ordersperpage;
        const paginated = Filtered.slice(start, end);

        // Render the filtered and paginated orders
        paginated.forEach(order => {
            const orderItem = document.createElement('tr');
            orderItem.className = 'order-item';
            orderItem.innerHTML = `
                <td>${order.id}</td>
                <td>${order.ProductID}</td>
                <td>${order.Quantity}</td>
                <td>${order.UnitPrice * order.Quantity}</td>
                <td>${order.created_at}</td>
            `;
            orders.appendChild(orderItem);
            count++;
        });

        renderPaginationControls(orders, totalPages, currentPage, 0, search, UpdateOrderList);

        console.log(count + ' Orders Found.');
        return true;
    }

    let searchbar = order_management ? order_management : document;
    searchbar.querySelector('#Search').addEventListener('keyup', function(event) {
        // Get Text Content from Text Field.
        search = this.value;

        console.log(search + ' Added to Search.');

        // Send Request.
        UpdateOrderList(search, currentPage);
    })
});