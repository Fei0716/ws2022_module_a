//Here is your CODE!
document.addEventListener("DOMContentLoaded",function(e){
    document.querySelector('.render-btn').addEventListener("click",render);
});

var render = (e) => {

    let selectedText = window.getSelection();
    if (selectedText.rangeCount > 0) {
        let range = selectedText.getRangeAt(0);
        let selectionContents = range.cloneContents();

        // Check if selection spans multiple paragraphs
        let paragraphs = selectionContents.querySelectorAll('p');
        if (paragraphs.length > 1) {
            // Iterate over each paragraph
            paragraphs.forEach(paragraph => {
                const highlightedSpan = document.createElement('span');
                highlightedSpan.classList.add('highlight');
                highlightedSpan.textContent = paragraph.textContent;
                // Apply styles to the highlighted span
                highlightedSpan.style.backgroundColor = 'yellow';
                highlightedSpan.style.color = 'red';

                // Create a new paragraph to contain the highlighted content
                const newParagraph = document.createElement('p');
                newParagraph.appendChild(highlightedSpan);
                // Insert the new paragraph before the original paragraph
                paragraph.parentNode.insertBefore(newParagraph, paragraph);
            });

            // Remove the original paragraphs
            paragraphs.forEach(paragraph => {
                paragraph.parentNode.removeChild(paragraph);
            });
        
        } else {
            const highlightedSpan = document.createElement('span');
            highlightedSpan.classList.add('highlight');
            highlightedSpan.appendChild(selectionContents);

            // Apply styles to the highlighted span
            highlightedSpan.style.backgroundColor = 'yellow';
            highlightedSpan.style.color = 'red';

            // Remove existing selection and insert the highlighted span
            range.deleteContents();
            range.insertNode(highlightedSpan);
        }
    }
};