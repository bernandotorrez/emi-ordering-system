<script>
function showHideAddButton(month) {
    var currentDate = "{{date('d-m-Y')}}"
    var addButtonEl = document.getElementById('addButton')
    var currentMonth = currentDate.split('-')[1]
    console.log(currentMonth)
    if(month == currentDate) {
        addButtonEl.style.display = 'inline-flex'
    } else {
        addButtonEl.style.display = 'none'
    }
}
</script>