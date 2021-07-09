<script>
    $(document).ready(() => {
        const anchors = document.getElementById('mainNav').getElementsByTagName('a');
        for (let index = 0; index < anchors.length; index++) {
            if (anchors[index].classList['value'] === 'active') {
                anchors[index].parentNode.parentNode.parentNode.classList.add('in');
                return;
            }
        }
    });
</script>