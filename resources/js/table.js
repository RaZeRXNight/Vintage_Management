import { renderPaginationControls } from './pagination.js';

// A Runnable Javascript code that creates tables with pagination and search functionality.
// Dynamically creates table based on data provided in JSON format.

document.addEventListener('DOMContentLoaded', () => { 
    // Get Data from Hidden Inputs
    const productsData = document.getElementById('products-data');
    const salesData = document.getElementById('sales-data');
    const ordersData = document.getElementById('orders-data');
    const categoriesData = document.getElementById('categories-data');

    // Check if any data is missing
    if (!productsData || !salesData || !ordersData || !categoriesData) {
        return null;
    }

    const products = JSON.parse(productsData.value);
    const sales = JSON.parse(salesData.value);
    const orders = JSON.parse(ordersData.value);
    const categories = JSON.parse(categoriesData.value);

    

    // Initialize Date
    let date = null;
    // Initialize Variables
    const table = document.querySelector('#data-table');
    const searchInput = document.querySelector('#search-input');
    const paginationContainer = document.querySelector('#pagination');

    // Fetch Data
    async function fetchData() {
        const response = await fetch('/api/data');
        const data = await response.json();
        return data;
    }

    // Render Table
    function renderTable(data, date) {
        table.innerHTML = '';
        if (!date) {
            date = null
        }
        data.forEach(item => {
            // Check if the item has a date and format it
            if (item.created_at) {
                // item.created_at = new Date(item.created_at);
                item.created_at = item.created_at.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: '2-digit',
                    week: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }
            // Compare date with the provided date
            if (date && item.created_at !== date) {
                return; // Skip this item if the date does not match
            }

            let extra = '';
            if (data === products) {
                extra += `<td>${item.name}</td>
                 <td>${item.category}</td>
                 <td>${item.price}</td>`;
            } else if (data === sales) {
                extra +=`<td>${item.productName}</td>
                 <td>${item.quantity}</td>
                 <td>${item.totalPrice}</td>`;
            } else if (data === orders) {
                extra += `<td>${item.ProductID}</td>
                 <td>${item.Quantity}</td>
                 <td>${item.UnitPrice * item.Quantity}</td>
                 <td>${item.created_at}</td>`;
            } else if (data === categories) {
                extra += `<td>${item.name}</td>`;
            }
            extra += `<td>${item.created_at}</td>`;

            const row = document.createElement('tr');
            row.innerHTML = ` <td>${item.id}</td> ` + extra; 
            table.appendChild(row);
        });
    }

    function initTable(data,  date, pagination) {
        renderTable(data, date);
        renderPaginationControls(pagination);
    }
});