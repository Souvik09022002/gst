
function test(n) {
    if (n < 0) return 'Minus ' + test(-n);
    if (n === 0) return 'Zero';

    const single_digit = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
    const double_digit = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
    const below_hundred = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

    function translate(n) {
        let word = "";
        if (n < 10) {
            word = single_digit[n] + ' ';
        } else if (n < 20) {
            word = double_digit[n - 10] + ' ';
        } else if (n < 100) {
            word = below_hundred[Math.floor(n / 10) - 2] + ' ' + translate(n % 10);
        } else if (n < 1000) {
            word = single_digit[Math.floor(n / 100)] + ' Hundred ' + translate(n % 100);
        } else if (n < 1000000) {
            word = translate(Math.floor(n / 1000)) + ' Thousand ' + translate(n % 1000);
        } else if (n < 1000000000) {
            word = translate(Math.floor(n / 1000000)) + ' Million ' + translate(n % 1000000);
        } else {
            word = translate(Math.floor(n / 1000000000)) + ' Billion ' + translate(n % 1000000000);
        }
        return word.trim();
    }

    return translate(n).toUpperCase() + ' RUPEES ONLY';
}

function updateTotalInWords(netAmount) {
    const amount = Math.floor(netAmount);
    const totalInWords = test(amount);
    document.getElementById('totalInWords').textContent = totalInWords;
}

window.onload = function () {
    const netAmountStr = '{{ $allDetailsById->net_amount }}';
    const netAmountClean = netAmountStr.replace(/,/g, '');
    const netAmount = parseFloat(netAmountClean);

    if (!isNaN(netAmount)) {
        updateTotalInWords(netAmount);
    } else {
        document.getElementById('totalInWords').textContent = 'Invalid Amount';
    }

};

function printDiv(e){
    let head = '<html><head><titel>'+document.title+'</titel></head>'
    let footer = '</body></html>';

    var new_str = document.getElementById(e).innerHTML;
    let old_str = document.body.innerHTML;
    document.body.innerHTML = head + new_str + footer;
    window.print();
    document.body.innerHTML = old_str;
    return false;

}
