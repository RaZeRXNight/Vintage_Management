

function renderPaginationControls(target, totalPages, page, categoryID, Search, UpdateList) {
    let paginationContainer = target.querySelector('#pagination-controls');
    if (!paginationContainer) {
        paginationContainer = document.createElement('div');
        paginationContainer.id = 'pagination-controls';
        paginationContainer.className = 'pagination-controls';
        target.appendChild(paginationContainer);
    }
    paginationContainer.innerHTML = '';

    if (totalPages <= 1) return;

    const prevBtn = document.createElement('button');
    prevBtn.textContent = 'Prev';
    prevBtn.disabled = page === 1;
    if (categoryID !== null) { prevBtn.onclick = () => UpdateList(categoryID, Search, page - 1); }
    else if (categoryID === null) { prevBtn.onclick = () => UpdateList(); }
    
    paginationContainer.appendChild(prevBtn);

    // Page numbers
    for (let i = 1; i <= totalPages; i++) {
        const pageBtn = document.createElement('button');
        pageBtn.textContent = i;
        if (i === page) pageBtn.disabled = true;
        pageBtn.onclick = () => UpdateList(categoryID, Search, i);
        paginationContainer.appendChild(pageBtn);
    }

    // Next button
    const nextBtn = document.createElement('button');
    nextBtn.textContent = 'Next';
    nextBtn.disabled = page === totalPages;
    nextBtn.onclick = () => UpdateList(categoryID, Search, page + 1);
    paginationContainer.appendChild(nextBtn);

}

// Export the function for use in other modules
export { renderPaginationControls };