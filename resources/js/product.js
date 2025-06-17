import { renderPaginationControls } from './pagination.js';

document.addEventListener('DOMContentLoaded', () => {
    // Initialize product management functionality here
    const product_management = document.getElementById('product-management');

    const product = document.getElementById('product-items') || 
    document.getElementById('cart-product-items');
    const categories = document.getElementById('Category-items');
    const current_category = document.getElementById('Current_Filter');

    if (!product || !categories) {
        return;
    };

    const productsperpage = 10;
    const productsperrow = 5;
    let page = 1;
    let category = 0;
    let search = null;

    const products = JSON.parse(document.getElementById('products-data').value)
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    UpdateProductList(category);

    // Gets Search Result and Sends an Update Product List Request.
    let searchbar = product_management ? product_management : Transaction;
    searchbar.querySelector('#Search').addEventListener('keyup', function(event) {
        // Get Text Content from Text Field.
        search = this.value;

        console.log(category + search + ' Added to Search.');

        // Send Request.
        UpdateProductList(category, search);
    })

    // Finds Each Button within the Categories Options Div and Attaches an Event.
    document.querySelectorAll('#Category-items button').forEach(btn => {
        btn.addEventListener('click', function() {
            const categoryName = this.textContent.trim();
            category = this.dataset.id;

            console.log(categoryName + ' ID ' + category + ' Category Selected');

            // Input into Function to Update Product List
            if (UpdateProductList(category)) {
                current_category.innerHTML = 'Showing ' + categoryName;
            }
        });
    });

    // Updates the Cart's Items Based on The Filtered Category and Search.  
    // Creates Pagination at the end.
    function UpdateProductList(categoryID, Search, page = 1) {
        // Setting Current Filter
        let Filtered = null;
        let count = 0;

        if (categoryID == 0 && !Search) { 
            Filtered = products; 
            console.log('Loaded All');
        } 
        else if (Search) {
            Filtered = products.filter(p=>
                p.ProductName.toLowerCase().includes(Search.toLowerCase())  &&
                (categoryID == 0 || p.CategoryID == categoryID)
            );

            console.log('Searching for ' + Search + ' ...')
        }
        else { 
            Filtered = products.filter(p => p.CategoryID == categoryID); 
        }

        // Set Up Pagination Properties
        const totalProducts = Filtered.length;
        const totalPages = Math.ceil(totalProducts / productsperpage);
        page = Math.max(1, Math.min(page, totalPages));

        const start = (page - 1) * productsperpage;
        const end = start + productsperpage;
        const paginated = Filtered.slice(start, end);

        // Clear table body
        product.innerHTML = '';

        // Fill Table
        paginated.forEach(item => {
            if (product.id == 'product-items') {
                // Create Table row For Each
                const row = document.createElement('tr');

                // Add Table Details
                row.innerHTML = `<td>${item.id}</td>
                    <td>${item.CategoryID}</td>
                    <td><a href="/product_management/view_product/${item.id}">${item.ProductName}</a></td>
                    <td>${item.Description}</td>
                    <td>$${item.UnitPrice}</td>
                    <td>${item.UnitsInStock}</td>
                    <td><a href="/product_management/update_product/${item.id}" class="btn btn-warning">Edit</a></td>
                    <td><form action="/product_management/delete_product/${item.id}" method="POST">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>`;
                product.appendChild(row);
            } else if (product.id == 'cart-product-items') {
                // Get the Latest Div Element.

                let row = product.lastElementChild;

                // If the Count is diminished and equals 0 we make a new row for future elements.
                if (count % productsperrow == 0) {
                    row = document.createElement('div');
                    row.className = 'flex flex-row justify-center max-h-45 border rounded min-w-full max-w-full';
                }
                // We create a product card for each one and place them into the row element.
                let card = document.createElement('div');
                card.className = 'product-card';
                card.dataset.name = item.ProductName;
                card.dataset.size = item.Size;
                card.dataset.id = item.id;
                card.dataset.price = item.UnitPrice;
                card.dataset.quantity = item.UnitsInStock;
            
                card.innerHTML = `
                <button class="add-to-cart">
                    <img class="rounded-t-2xl max-h-30" id="product-img-${item.id}"
                        src='/storage/${item.ProductIMG}' alt='Product Image' />
                </button>

                <div class='flex flex-col max-w-full border divide-x-1 text-center'>
                    <div class='max-w-full border text-center'>
                        <span>${item.ProductName}</span>
                    </div>

                    <div class='flex flex-row justify-around max-w-full border'>
                        <span>$ ${item.UnitPrice}</span>
                        <span>${item.UnitsInStock}</span>
                    </div>
                </div>
                `;   

                row.appendChild(card);  
                product.appendChild(row);  
                count++;
                if (count % productsperrow == 0) {
                    
                }  

            }
        });   

        let pagination_target = product_management ? product_management : document;

        renderPaginationControls(pagination_target, totalPages, page, categoryID, Search, UpdateProductList);

        return true;
    }
});