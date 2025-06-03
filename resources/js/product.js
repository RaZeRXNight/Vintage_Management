
document.addEventListener('DOMContentLoaded', () => {
    const products = JSON.parse(document.getElementById('products-data').value)
    const product = document.getElementById('product-items');
    const categories = document.getElementById('Category-items');
    const current_category = document.getElementById('Current_Filter');
    if (!product || !categories) {
        return;
    };

    document.querySelectorAll('#Category-items button').forEach(btn => {
        btn.addEventListener('click', function() {
            const categoryName = this.textContent.trim();
            const categoryID = this.dataset.id;
            
            console.log(categoryName + ' ID ' + categoryID + ' Category Selected');

            // Input into Function to Update Product List
            if (UpdateProductList(categoryID)) {
                current_category.innerHTML = 'Showing ' + categoryName;
            }
        });
    });

    function UpdateProductList(categoryID) {
        // Setting Current Filter
        let Filtered = null;
        if (categoryID == 0) { Filtered = products; } 
        else { Filtered = products.filter(p => p.CategoryID == categoryID); }

        // Clear table body
        product.innerHTML = '';
        Filtered.forEach(item => {

            // Create Table row For Each
            const row = document.createElement('tr');

            // Add Table Details
            row.innerHTML = `
                <td>${item.ID}</td>
                <td><a href="/product_management/view_product/${item.ID}">${item.ProductName}</a></td>
                <td>${item.Description}</td>
                <td>$${item.UnitPrice}</td>
                <td><a href="/product_management/edit_product/${item.ID}" class="btn btn-warning">Edit</a></td>
                <td>
                    <form action="/product_management/delete_product/${item.ID}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            `;
            product.appendChild(row);
        });   
        return true;
    }
});