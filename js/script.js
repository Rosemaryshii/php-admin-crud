// Custom Loader Element Node
var loader = document.createElement('div')
loader.setAttribute('id', 'pre-loader');
loader.innerHTML = "<div class='lds-hourglass'></div>";

// Loader Start Function
window.start_loader = function() {
    if (!document.getElementById('pre-loader') || (!!document.getElementById('pre-loader') && document.getElementById('pre-loader').length <= 0))
        document.querySelector('body').appendChild(loader)
}

// Loader Stop Function
window.end_loader = function() {
    if (!!document.getElementById('pre-loader')) {
        setTimeout(() => {
            document.getElementById('pre-loader').remove()
        }, 500)
    }
}

var prod_ajax, products, listed, total = 0,
    change = 0;

function product_actions(_this, data) {
    var form = $("#add-form")
    _this.click(function() {
        form.find('input[name="name"]').val(data.name)
        form.find('input[name="price"]').val(data.price)
        $('#pname').text(data.name)
        $('#pprice').text(parseFloat(data.price).toLocaleString('en-US'))
        $('#find-product').val('').trigger('input')
    })

}

function update_total() {
    $('#total-amount').text(parseFloat(total).toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2, minimumFractionDigits: 2 }))
    $('#checkout-amount').val(parseFloat(total).toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2, minimumFractionDigits: 2 }))
}

function load_products() {
    if (prod_ajax) {
        prod_ajax.abort()
    }
    find_prod_ajax = $.ajax({
        url: 'retrieve_products.php',
        dataType: 'json',
        error: err => {
            alert('An error occurred.')
            console.error(err)
        },
        success: function(resp) {
            products = resp
            $('#product-result').html('')
            Object.keys(resp).map(k => {
                var item = $($('noscript#prod-item-clone').html()).clone()
                item.find('.prod_name').text(resp[k].name)
                item.find('.prod_price').text(parseFloat(resp[k].price).toLocaleString('en-US'))
                item.find('.prod_price').attr('data-id', resp[k].price)
                $('#product-result').append(item)
                product_actions(item, resp[k])
            })
        }
    })
}

function check_items() {
    if ($("#item-list tbody").is(':empty') == true) {
        $('#noItem').removeClass('d-none')
    } else {
        if ($('#noItem').hasClass('d-none') == false)
            $('#noItem').addClass('d-none');
    }
}

function item_actions(_this, key) {
    _this.find('.rem-item').click(function() {
        if (!!listed[key]) {
            _this.remove()
            delete listed[key];
            listed = Object.keys(listed).map(k => { return listed[k] != null ? listed[k] : false })
            localStorage.setItem('listed', JSON.stringify(listed))
        }
        check_items()
        load_list()
    })
    _this.find('.length1').on('change input', function() {
        if (!!listed[key]) {
          listed[key].length1 = parseFloat($(this).val());
          localStorage.setItem('listed', JSON.stringify(listed));
        }
        load_list();
      });
      _this.find('.width').on('change input', function() {
        if (!!listed[key]) {
          listed[key].width = parseFloat($(this).val());
          localStorage.setItem('listed', JSON.stringify(listed));
        }
        load_list();
      });
    _this.find('.qty').on('change input', function() {
        if (!!listed[key]) {
            listed[key].qty = $(this).val()
            localStorage.setItem('listed', JSON.stringify(listed))
        }
        load_list()
    })
    _this.find('.remarks').on('change input', function() {
        // Perform actions based on the entered remarks
        if (!!listed[key]) {
            listed[key].remarks = $(this).val();
            // Do something with the remarks
            // (e.g., store them in localStorage without JSON conversion)
            localStorage.setItem('listed', JSON.stringify(listed));
        }
        // Call a function to load or update the list based on the remarks
        load_list();
    });
    
}

function load_list() {
    listed = !!localStorage.getItem('listed') ? $.parseJSON(localStorage.getItem('listed')) : [];
    total = 0;
    $('#item-list tbody').html('')
    if (Object.keys(listed).length > 0) {
        Object.keys(listed).map((k) => {
            var item = $($('noscript#item-tr-clone').html()).clone()
            item.find('.qty').val(parseFloat(listed[k].qty))
            item.find('.length1').val(parseFloat(listed[k].length1))
            item.find('.width').val(parseFloat(listed[k].width))
            item.find('.remarks').val(listed[k].remarks)
            item.find('#original-length').text(parseFloat(listed[k].length1));
item.find('#original-width').text(parseFloat(listed[k].width));
            item.find('.item-name').text(listed[k].product)
            item.find('.item-price').text(parseFloat(listed[k].price).toLocaleString('en-US'))
            item.find('.item-total').text(Math.trunc(parseFloat(parseFloat(listed[k].price) * parseFloat(listed[k].qty) * (parseFloat(listed[k].length1) >= 1 && parseFloat(listed[k].length1) <= 6.9 ? 0.5 :parseFloat(listed[k].length1) >= 7 && parseFloat(listed[k].length1) <= 8.9 ? 0.75 : parseFloat(listed[k].length1) >= 9 && parseFloat(listed[k].length1) <= 12.4 ? 1 :
            parseFloat(listed[k].length1) >= 12.5 && parseFloat(listed[k].length1) <= 15.4 ? 1.25 :
            parseFloat(listed[k].length1) >= 15.5 && parseFloat(listed[k].length1) <= 18.9 ? 1.5 :
            parseFloat(listed[k].length1) >= 19 && parseFloat(listed[k].length1) <= 24.9 ? 2.15 :
            parseFloat(listed[k].length1) >= 25 && parseFloat(listed[k].length1) <= 30.9 ? 2.75 :
            parseFloat(listed[k].length1) >= 31 && parseFloat(listed[k].length1) <= 38.9 ? 3 :
            parseFloat(listed[k].length1) >= 39 && parseFloat(listed[k].length1) <= 42.9 ? 3.5 :
            parseFloat(listed[k].length1) >= 43 && parseFloat(listed[k].length1) <= 48.9 ? 4 :
            parseFloat(listed[k].length1) >= 49 && parseFloat(listed[k].length1) <= 54.9 ? 4.5 :
            parseFloat(listed[k].length1) >= 55 && parseFloat(listed[k].length1) <= 65.9 ? 5.5 :
            parseFloat(listed[k].length1) >= 66 && parseFloat(listed[k].length1) <= 72.9 ? 6 :
            parseFloat(listed[k].length1) >= 73 && parseFloat(listed[k].length1) <= 84.9 ? 7 :
            parseFloat(listed[k].length1) >= 85 && parseFloat(listed[k].length1) <= 96.9 ? 8 :
            parseFloat(listed[k].length1) >= 97 && parseFloat(listed[k].length1) <= 108 ? 9 :
            parseFloat(listed[k].length1) >= 109 && parseFloat(listed[k].length1) <= 120 ? 10 :
            parseFloat(listed[k].length1) >= 121 && parseFloat(listed[k].length1) <= 133 ? 11 : 0)) * (parseFloat(listed[k].width) >= 1 && parseFloat(listed[k].width) <= 6.9 ? 0.5 :parseFloat(listed[k].width) >= 7 && parseFloat(listed[k].width) <= 8.9 ? 0.75 : parseFloat(listed[k].width) >= 9 && parseFloat(listed[k].width) <= 12.4 ? 1 :
            parseFloat(listed[k].width) >= 12.5 && parseFloat(listed[k].width) <= 15.4 ? 1.25 :
            parseFloat(listed[k].width) >= 15.5 && parseFloat(listed[k].width) <= 18.9 ? 1.5 :
            parseFloat(listed[k].width) >= 19 && parseFloat(listed[k].width) <= 24.9 ? 2.15 :
            parseFloat(listed[k].width) >= 25 && parseFloat(listed[k].width) <= 30.9 ? 2.75 :
            parseFloat(listed[k].width) >= 31 && parseFloat(listed[k].width) <= 38.9 ? 3 :
            parseFloat(listed[k].width) >= 39 && parseFloat(listed[k].width) <= 42.9 ? 3.5 :
            parseFloat(listed[k].width) >= 43 && parseFloat(listed[k].width) <= 48.9 ? 4 :
            parseFloat(listed[k].width) >= 49 && parseFloat(listed[k].width) <= 54.9 ? 4.5 :
            parseFloat(listed[k].width) >= 55 && parseFloat(listed[k].width) <= 65.9 ? 5.5 :
            parseFloat(listed[k].width) >= 66 && parseFloat(listed[k].width) <= 72.9 ? 6 :
            parseFloat(listed[k].width) >= 73 && parseFloat(listed[k].width) <= 84.9 ? 7 :
            parseFloat(listed[k].width) >= 85 && parseFloat(listed[k].width) <= 96.9 ? 8 :
            parseFloat(listed[k].width) >= 97 && parseFloat(listed[k].width) <= 108 ? 9 :
            parseFloat(listed[k].width) >= 109 && parseFloat(listed[k].width) <= 120 ? 10 :
            parseFloat(listed[k].width) >= 121 && parseFloat(listed[k].width) <= 133 ? 11 : 0))).toLocaleString('en-US')

            total += Math.trunc(parseFloat(listed[k].price) * parseFloat(listed[k].qty) * (parseFloat(listed[k].length1) >= 1 && parseFloat(listed[k].length1) <= 6.9 ? 0.5 :parseFloat(listed[k].length1) >= 7 && parseFloat(listed[k].length1) <= 8.9 ? 0.75 : parseFloat(listed[k].length1) >= 9 && parseFloat(listed[k].length1) <= 12.4 ? 1 :
            parseFloat(listed[k].length1) >= 12.5 && parseFloat(listed[k].length1) <= 15.4 ? 1.25 :
            parseFloat(listed[k].length1) >= 15.5 && parseFloat(listed[k].length1) <= 18.9 ? 1.5 :
            parseFloat(listed[k].length1) >= 19 && parseFloat(listed[k].length1) <= 24.9 ? 2.15 :
            parseFloat(listed[k].length1) >= 25 && parseFloat(listed[k].length1) <= 30.9 ? 2.75 :
            parseFloat(listed[k].length1) >= 31 && parseFloat(listed[k].length1) <= 38.9 ? 3 :
            parseFloat(listed[k].length1) >= 39 && parseFloat(listed[k].length1) <= 42.9 ? 3.5 :
            parseFloat(listed[k].length1) >= 43 && parseFloat(listed[k].length1) <= 48.9 ? 4 :
            parseFloat(listed[k].length1) >= 49 && parseFloat(listed[k].length1) <= 54.9 ? 4.5 :
            parseFloat(listed[k].length1) >= 55 && parseFloat(listed[k].length1) <= 65.9 ? 5.5 :
            parseFloat(listed[k].length1) >= 66 && parseFloat(listed[k].length1) <= 72.9 ? 6 :
            parseFloat(listed[k].length1) >= 73 && parseFloat(listed[k].length1) <= 84.9 ? 7 :
            parseFloat(listed[k].length1) >= 85 && parseFloat(listed[k].length1) <= 96.9 ? 8 :
            parseFloat(listed[k].length1) >= 97 && parseFloat(listed[k].length1) <= 108 ? 9 :
            parseFloat(listed[k].length1) >= 109 && parseFloat(listed[k].length1) <= 120 ? 10 :
            parseFloat(listed[k].length1) >= 121 && parseFloat(listed[k].length1) <= 133 ? 11 : 0) * (parseFloat(listed[k].width) >= 1 && parseFloat(listed[k].width) <= 6.9 ? 0.5 :parseFloat(listed[k].width) >= 7 && parseFloat(listed[k].width) <= 8.9 ? 0.75 : parseFloat(listed[k].width) >= 9 && parseFloat(listed[k].width) <= 12.4 ? 1 :
            parseFloat(listed[k].width) >= 12.5 && parseFloat(listed[k].width) <= 15.4 ? 1.25 :
            parseFloat(listed[k].width) >= 15.5 && parseFloat(listed[k].width) <= 18.9 ? 1.5 :
            parseFloat(listed[k].width) >= 19 && parseFloat(listed[k].width) <= 24.9 ? 2.15 :
            parseFloat(listed[k].width) >= 25 && parseFloat(listed[k].width) <= 30.9 ? 2.75 :
            parseFloat(listed[k].width) >= 31 && parseFloat(listed[k].width) <= 38.9 ? 3 :
            parseFloat(listed[k].width) >= 39 && parseFloat(listed[k].width) <= 42.9 ? 3.5 :
            parseFloat(listed[k].width) >= 43 && parseFloat(listed[k].width) <= 48.9 ? 4 :
            parseFloat(listed[k].width) >= 49 && parseFloat(listed[k].width) <= 54.9 ? 4.5 :
            parseFloat(listed[k].width) >= 55 && parseFloat(listed[k].width) <= 65.9 ? 5.5 :
            parseFloat(listed[k].width) >= 66 && parseFloat(listed[k].width) <= 72.9 ? 6 :
            parseFloat(listed[k].width) >= 73 && parseFloat(listed[k].width) <= 84.9 ? 7 :
            parseFloat(listed[k].width) >= 85 && parseFloat(listed[k].width) <= 96.9 ? 8 :
            parseFloat(listed[k].width) >= 97 && parseFloat(listed[k].width) <= 108 ? 9 :
            parseFloat(listed[k].width) >= 109 && parseFloat(listed[k].width1) <= 120 ? 10 :
            parseFloat(listed[k].width) >= 121 && parseFloat(listed[k].width) <= 133 ? 11 : 0));
            $('#item-list tbody').append(item)
            item_actions(item, k)
            update_total()
        })
        
    }
    check_items()
}
$(function() {
    check_items()
    load_list()
    var load_prod = new Promise((resolve) => {
        load_products()
        resolve()
    })
    console.log(load_prod)
    load_prod.then(() => {
        end_loader()
    })
    $('#find-product').on('input', function() {
        var search = $(this).val().toLowerCase()
        if (search == '') {
            if (!$('#product-result').hasClass('d-none'))
                $('#product-result').addClass('d-none');
            return false;
        }
        $('#product-result').removeClass('d-none');
        $('#product-result .prod-item').each(function() {
            var name = $(this).find('.prod_name').text().toLowerCase()
            if (name.includes(search) === true) {
                $(this).toggle(true)
            } else {
                $(this).toggle(false)
            }

        })

    })
    $('#add-form').submit(function(e) {
        e.preventDefault()
        start_loader()
        var _this = $(this)
        var product = _this.find('[name="name"]').val()
        var price = _this.find('[name="price"]').val()
        var length1 = _this.find('[name="length1"]').val()
        var width = _this.find('[name="width"]').val()
        var qty = _this.find('[name="qty"]').val()
        var remarks = _this.find('[name="remarks"]').val()
        listed[listed.length] = { product: product, price: price,length1:length1, width:width, remarks:remarks, qty: qty }
        localStorage.setItem('listed', JSON.stringify(listed))
        _this[0].reset()
        _this.find('[name="name"]').val('')
        _this.find('[name="price"]').val('')
        $('#pname').text('')
        $('#pprice').text('')
        load_list()
        end_loader()
    })

    $('#checkout').click(function() {
        $('#checkoutModal').modal('show')
        $('#checkoutModal').on('shown.bs.modal', function() {
            $('#checkout-tendered').focus()
            $('#checkout-tendered').on('change input', function() {
                var pay = $(this).val()
                // change = parseFloat(pay) - parseFloat(total)
                // $('#checkout-change').val(parseFloat(change).toLocaleString('en-US'))
            })
        })
    })
    $('#checkout-form').submit(function(e) {
        e.preventDefault()
        start_loader()
        if (change >= 0) {
            $.ajax({
                url: './receipt_format.html',
                error: err => {
                    console.error(err)
                    alert('An error occurred.')
                    end_loader()
                },
                success: function(resp) {
                    var el = $('<div>')
                    el.html(resp)
                    el.find('#r-total').text(parseFloat(total).toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2, minimumFractionDigits: 2 }))
                    // el.find('#r-tendered').text(parseFloat(parseFloat(total) + parseFloat(change)).toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2, minimumFractionDigits: 2 }))
                    // el.find('#r-change').text(parseFloat(change).toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2, minimumFractionDigits: 2 }))
                    Object.keys(listed).map((k) => {
                        
                        el.find('#product-list').append('<div class="col-2 text-start lh-1">' + (listed[k].product)  + '</small></div></div>')
                        el.find('#product-list').append('<div class="col-1 text-start">' + (parseFloat(listed[k].length1).toLocaleString('en-US')) + '</div>')
                        el.find('#product-list').append('<div class="col-1 text-start">' + (parseFloat(listed[k].width).toLocaleString('en-US')) + '</div>')
                        el.find('#product-list').append('<div class="col-1 text-start">' + (parseFloat(listed[k].qty).toLocaleString('en-US')) + '</div>')
                        el.find('#product-list').append('<div class="col-1 text-start">' + Math.trunc(parseFloat(parseFloat(listed[k].price) * parseFloat(listed[k].qty) * (parseFloat(listed[k].length1) >= 1 && parseFloat(listed[k].length1) <= 6.9 ? 0.5 :parseFloat(listed[k].length1) >= 7 && parseFloat(listed[k].length1) <= 8.9 ? 0.75 : parseFloat(listed[k].length1) >= 9 && parseFloat(listed[k].length1) <= 12.4 ? 1 :
                        parseFloat(listed[k].length1) >= 12.5 && parseFloat(listed[k].length1) <= 15.4 ? 1.25 :
                        parseFloat(listed[k].length1) >= 15.5 && parseFloat(listed[k].length1) <= 18.9 ? 1.5 :
                        parseFloat(listed[k].length1) >= 19 && parseFloat(listed[k].length1) <= 24.9 ? 2.15 :
                        parseFloat(listed[k].length1) >= 25 && parseFloat(listed[k].length1) <= 30.9 ? 2.75 :
                        parseFloat(listed[k].length1) >= 31 && parseFloat(listed[k].length1) <= 38.9 ? 3 :
                        parseFloat(listed[k].length1) >= 39 && parseFloat(listed[k].length1) <= 42.9 ? 3.5 :
                        parseFloat(listed[k].length1) >= 43 && parseFloat(listed[k].length1) <= 48.9 ? 4 :
                        parseFloat(listed[k].length1) >= 49 && parseFloat(listed[k].length1) <= 54.9 ? 4.5 :
                        parseFloat(listed[k].length1) >= 55 && parseFloat(listed[k].length1) <= 65.9 ? 5.5 :
                        parseFloat(listed[k].length1) >= 66 && parseFloat(listed[k].length1) <= 72.9 ? 6 :
                        parseFloat(listed[k].length1) >= 73 && parseFloat(listed[k].length1) <= 84.9 ? 7 :
                        parseFloat(listed[k].length1) >= 85 && parseFloat(listed[k].length1) <= 96.9 ? 8 :
                        parseFloat(listed[k].length1) >= 97 && parseFloat(listed[k].length1) <= 108 ? 9 :
                        parseFloat(listed[k].length1) >= 109 && parseFloat(listed[k].length1) <= 120 ? 10 :
                        parseFloat(listed[k].length1) >= 121 && parseFloat(listed[k].length1) <= 133 ? 11 : 0)) * (parseFloat(listed[k].width) >= 1 && parseFloat(listed[k].width) <= 6.9 ? 0.5 :parseFloat(listed[k].width) >= 7 && parseFloat(listed[k].width) <= 8.9 ? 0.75 : parseFloat(listed[k].width) >= 9 && parseFloat(listed[k].width) <= 12.4 ? 1 :
                        parseFloat(listed[k].width) >= 12.5 && parseFloat(listed[k].width) <= 15.4 ? 1.25 :
                        parseFloat(listed[k].width) >= 15.5 && parseFloat(listed[k].width) <= 18.9 ? 1.5 :
                        parseFloat(listed[k].width) >= 19 && parseFloat(listed[k].width) <= 24.9 ? 2.15 :
                        parseFloat(listed[k].width) >= 25 && parseFloat(listed[k].width) <= 30.9 ? 2.75 :
                        parseFloat(listed[k].width) >= 31 && parseFloat(listed[k].width) <= 38.9 ? 3 :
                        parseFloat(listed[k].width) >= 39 && parseFloat(listed[k].width) <= 42.9 ? 3.5 :
                        parseFloat(listed[k].width) >= 43 && parseFloat(listed[k].width) <= 48.9 ? 4 :
                        parseFloat(listed[k].width) >= 49 && parseFloat(listed[k].width) <= 54.9 ? 4.5 :
                        parseFloat(listed[k].width) >= 55 && parseFloat(listed[k].width) <= 65.9 ? 5.5 :
                        parseFloat(listed[k].width) >= 66 && parseFloat(listed[k].width) <= 72.9 ? 6 :
                        parseFloat(listed[k].width) >= 73 && parseFloat(listed[k].width) <= 84.9 ? 7 :
                        parseFloat(listed[k].width) >= 85 && parseFloat(listed[k].width) <= 96.9 ? 8 :
                        parseFloat(listed[k].width) >= 97 && parseFloat(listed[k].width) <= 108 ? 9 :
                        parseFloat(listed[k].width) >= 109 && parseFloat(listed[k].width) <= 120 ? 10 :
                        parseFloat(listed[k].width) >= 121 && parseFloat(listed[k].width) <= 133 ? 11 : 0).toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2, minimumFractionDigits: 2 })) + '</div>')
                        el.find('#product-list').append('<div class="col-6 text-start">' + (listed[k].remarks).toLocaleString('en-US') + '</div>')
                    })

// + (parseFloat(listed[k].price).toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2, minimumFractionDigits: 2 }))
                    var nw = window.open('', '_blank', 'width=1000,height=900')
                    console.log(el.html())
                    nw.document.write(el.html())
                    nw.document.close()
                    setTimeout(() => {
                        nw.print()
                        setTimeout(() => {
                            nw.close()
                            end_loader()
                            $('.modal').modal('hide')
                            localStorage.setItem('listed', '[]')
                            location.reload()
                        }, 300)
                    }, 500)
                }
            })
        } else {
            alert("Tendered Amount less than payable amount!")
        }
    })
})