<form action="/generator" method="post">
    @csrf
    <input type="text" name="table_name" placeholder="Nhập tên bảng">

    <div id="columns">
        <div class="column">
            <input type="text" name="columns[0][name]" placeholder="Tên cột">
            
            <select name="columns[0][type]">
                <option value="string">string</option>
                <option value="integer">integer</option>
                <option value="float">float</option>
                <option value="boolean">boolean</option>
                <option value="text">text</option>
                <option value="date">date</option>
                <option value="datetime">datetime</option>
            </select>
        </div>
    </div>

    <button type="button" onclick="addColumn()">Thêm Cột</button>
    <button type="submit">Generate</button>
</form>


<script>
let columnIndex = 1;
function addColumn() {
    const columnsDiv = document.getElementById('columns');
    const html = `
        <div class="column">
            <input type="text" name="columns[${columnIndex}][name]" placeholder="Tên cột">
            <select name="columns[${columnIndex}][type]">
                <option value="string">string</option>
                <option value="integer">integer</option>
                <option value="float">float</option>
                <option value="boolean">boolean</option>
                <option value="text">text</option>
                <option value="date">date</option>
                <option value="datetime">datetime</option>
            </select>
        </div>
    `;
    columnsDiv.insertAdjacentHTML('beforeend', html);
    columnIndex++;
}
document.querySelector('form').addEventListener('submit', function(e) {
    let columnInputs = document.querySelectorAll('input[name*="[name]"]');
    let names = [];
    columnInputs.forEach(input => {
        if (names.includes(input.value)) {
            alert('Tên cột bị trùng: ' + input.value);
            e.preventDefault();
            return;
        }
        names.push(input.value);
    });
});
</script>
