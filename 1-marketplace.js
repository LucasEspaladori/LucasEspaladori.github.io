function ItemGroup(name, price, number) {
    this.name = name;
    this.price = price;
    this.number = number;
}

function Cart(){
    this.itemGroups = [];
    this.taxRate = 0.15;

    this.addItemGroup = function(itemGroup) {
        this.itemGroups.push(itemGroup);
    };

    this.getTotalAmount = function() {
        let amount = 0;
        
        for (let i = 0; i < this.itemGroups.length; i++) {
            const group = this.itemGroups[i];
            const itemTotal = group.price * group.number;
            amount += itemTotal;
        }

        return amount;
    };

    this.showTotalAmount = function(){
        const totalGroups = this.itemGroups.length;
        const totalBeforeTax = this.getTotalAmount();
        const taxAmount = totalBeforeTax * this.taxRate;
        const totalWithTax = totalBeforeTax + taxAmount;

        if (totalGroups === 0){
            // Modified text for 0 items to match the image: "0$"
            document.write("<p> You have 0 item, for a total amount of 0$, in your cart! </p>");
        } else  {
           
           // Use .toFixed(3) to match the three decimal places in the image
           const totalBeforeTax_fmt = totalBeforeTax.toFixed(3);
           const totalWithTax_fmt = totalWithTax.toFixed(3);
           
           document.write("<p>");
           // Changed "item group(s)" to "item(s)" to match the image
           document.write(`You have ${totalGroups} item(s) in your cart, for a total amount of ${totalBeforeTax_fmt}$. With taxes, this is ${totalWithTax_fmt}$.`);
           document.write("</p>");
        }
    };
}


document.write("<h2> 1) Creating the cart </h2>");
let my_cart = new Cart();
my_cart.showTotalAmount();

document.write("<h2> 2) Adding 15 pants at 10.05$ each to the cart! </h2>"); // Note the text change to "10.05$"
let pants = new ItemGroup("pants", 10.05, 15);
my_cart.addItemGroup(pants);
my_cart.showTotalAmount();

document.write("<h2> 3) Adding 1 coat at 99.99$ to the cart! </h2>"); // Note the text change to "99.99$"
let coat = new ItemGroup("coat", 99.99, 1);
my_cart.addItemGroup(coat);
my_cart.showTotalAmount();  