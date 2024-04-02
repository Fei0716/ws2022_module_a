document.addEventListener("DOMContentLoaded",function(){
    const textarea = document.querySelector('textarea');
    const preview = document.querySelector('#right');

    textarea.addEventListener('input', function(){
        renderMarkdown();
    });

    function renderMarkdown() {
        const markdown = textarea.value;
        const html = convertMarkdown(markdown);
        preview.innerHTML = html;
    }

    function convertMarkdown(markdown){
        let html = markdown;

        // Convert paragraphs and line breaks
        html = html.replace(/\n\n/g, '</p><p>');
        html = '<p>' + html.replace(/\n/g, '<br>') + '</p>';

        // Convert headings
        html = html.replace('/\b#/gim' ,'<h1>');
        // Convert bold
        html = html.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

        // Convert horizontal rule
        html = html.replace(/^---$/gm, '<hr>');

        // Convert lists
        html = html.replace(/^-\s*(.*?)$/gm, '<li>$1</li>');
        html = html.replace(/<li>.*?<\/li>/g, (match) => `<ul>${match}</ul>`);

        // Convert links
        html = html.replace(/\[([^\]]*?)\]\((.*?)\)/g, '<a href="$2">$1</a>');

        // Convert images
        html = html.replace(/!\[([^\]]*?)\]\((.*?)\)/g, '<img src="$2" alt="$1">');

        return html;
    }
});