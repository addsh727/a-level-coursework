// JS For Adding Category Image - Initialise variables
let uploadCategoryButton                        = document.getElementById("uploadCategory");
let chosenCategoryImage                         = document.getElementById("chosenCategoryImage");
let categoryFileName                            = document.getElementById("categoryImageName");

try{
    uploadCategoryButton.onchange = () => {
        let readerCategory = new FileReader();
        readerCategory.readAsDataURL(uploadCategoryButton.files[0]);
        console.log(uploadCategoryButton.files[0])
        readerCategory.onload = () => {
            chosenCategoryImage.setAttribute("src", readerCategory.result);
        }
        categoryFileName.textContent = uploadCategoryButton.files[0].name;
    }
} catch (e) {}

// JS For Editing Category Image - Initialise variables
let uploadChangeCategoryButton                  = document.getElementById("uploadChangeCategory");
let chosenChangeCategoryImage                   = document.getElementById("chosenChangeCategoryImage");
let changeCategoryFileName                      = document.getElementById("changeCategoryImageName");
try{
    uploadChangeCategoryButton.onchange = () => {
        let readerChangeCategory = new FileReader();
        readerChangeCategory.readAsDataURL(uploadChangeCategoryButton.files[0]);
        console.log(uploadChangeCategoryButton.files[0]);
        readerChangeCategory.onload = () => {
            chosenChangeCategoryImage.src = readerChangeCategory.result;
        }
        changeCategoryFileName.textContent = uploadChangeCategoryButton.files[0].name;
    }
} catch (e) {}

// JS For Adding Product Image - Initialise variables
let uploadProductButton                        = document.getElementById("uploadProduct");
let chosenProductImage                         = document.getElementById("chosenProductImage");
let productFileName                            = document.getElementById("productImageName");
try{
    uploadProductButton.onchange = () => {
        let readerProduct = new FileReader();
        readerProduct.readAsDataURL(uploadProductButton.files[0]);
        console.log(uploadProductButton.files[0])
        readerProduct.onload = () => {
            chosenProductImage.setAttribute("src", readerProduct.result);
        }
        productFileName.textContent = uploadProductButton.files[0].name;
    }
} catch (e) {}

// JS For Editing Product Image - Initialise variables
let uploadChangeProductButton                  = document.getElementById("uploadChangeProduct");
let chosenChangeProductImage                   = document.getElementById("chosenChangeProductImage");
let changeProductFileName                      = document.getElementById("changeProductImageName");
try{
    uploadChangeProductButton.onchange = () => {
        let readerChangeProduct = new FileReader();
        readerChangeProduct.readAsDataURL(uploadChangeProductButton.files[0]);
        console.log(uploadChangeProductButton.files[0]);
        readerChangeProduct.onload = () => {
            chosenChangeProductImage.src = readerChangeProduct.result;
        }
        changeProductFileName.textContent = uploadChangeProductButton.files[0].name;
    }
} catch (e) {}