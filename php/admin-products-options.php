<?php // Category Options
// Initialise image paths
$categoriesPath                                     = "./images/uploads/categories";
$productsPath                                       = "./images/uploads/products";

if(isset($_POST['submitCategory'])) // When new category added
{   // Retrieve new category details & image
    $categoryName                                   = $_POST['categoryName'];
    $categoryVisibility                             = isset($_POST['categoryVisibility']) ? '1':'0';
    $categoryPopular                                = isset($_POST['categoryPopular']) ? '1':'0';
    $categoryDescription                            = $_POST['categoryDescription'];
    $categoryMetaTitle                              = $_POST['categoryMetaTitle'];
    $categoryMetaDescription                        = $_POST['categoryMetaDescription'];
    $categoryMetaKeywords                           = $_POST['categoryMetaKeywords'];

    $categoryImage                                  = $_FILES['categoryImage']['name'];
    $image_ext                                      = pathinfo($categoryImage, PATHINFO_EXTENSION);
    $filename                                       = time().'.'.$image_ext;

    // Check if category with the same name already exists
    $queryCategoryExists                            = "SELECT * FROM `Categories` WHERE `CategoryName` = '$categoryName'";
    $categoryExists                                 = mysqli_query($dbconnect, $queryCategoryExists);

    if(mysqli_num_rows($categoryExists) > 0) // If category name already taken
    {   // Fire error alert & redirect to Categories table
        ?>
            <script type="text/javascript">
                errorAlert("Category Taken!", "Please use another name for this category.");
            </script>
            <script type="text/javascript">
                window.location.hash = '#Categories';
            </script>
        <?php
    }
    else// If not taken
    {   // Then insert new category record into the database
        $insertCategoryQuery                        = "INSERT INTO `Categories`(`CategoryID`, `CategoryName`, `CategoryDescription`,
                                                        `CategoryVisibility`, `CategoryPopular`, `CategoryImage`,
                                                        `MetaTitle`, `MetaDescription`, `MetaKeywords`,
                                                        `DateOfCreation`, `DateOfUpdate`
                                                    ) VALUES('', '$categoryName', '$categoryDescription',
                                                        '$categoryVisibility', '$categoryPopular', '$filename',
                                                        '$categoryMetaTitle', '$categoryMetaDescription', '$categoryMetaKeywords',
                                                        CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
                                                    )";
        $insertCategory                             = mysqli_query($dbconnect, $insertCategoryQuery);
        if($insertCategory) // When category is inserted
        {   // Move uploaded image to local uploads storage in category directory, fire success alert & redirect to Categories table
            move_uploaded_file($_FILES['categoryImage']['tmp_name'], $categoriesPath.'/'.$filename);
            ?>
            <script type="text/javascript">
                successAlert("New Category Inserted!", "New addition live now!");
            </script>
            <script type="text/javascript">
                window.location.hash = '#Categories';
            </script>
            <?php
        }
        else
        {   // Fire error alert & redirect to Products panel
            ?>
            <script type="text/javascript">
                errorAlert("Error...","Something went wrong while trying to add this new category...");
            </script>
            <script type="text/javascript">
                window.location.hash = '#Products';
            </script>
            <?php
        }
    }
}
if(isset($_POST['editCategoryButton'])) // When category is being edited
{   // Retrieve category details
    $categoryID                                     = mysqli_real_escape_string($dbconnect, $_POST['editCategoryID']);

    $queryCurrentCategory                           = "SELECT * FROM `Categories` WHERE `CategoryID` = '$categoryID'";
    $currentCategory                                = mysqli_query($dbconnect, $queryCurrentCategory);
    $foundCategory                                  = mysqli_fetch_assoc($currentCategory);

    $retrievedCategoryName                          = $foundCategory['CategoryName'];
    $retrievedCategoryDescription                   = $foundCategory['CategoryDescription'];
    $retrievedCategoryVisibility                    = $foundCategory['CategoryVisibility'];
    $retrievedCategoryPopular                       = $foundCategory['CategoryPopular'];
    $retrievedCategoryImage                         = $foundCategory['CategoryImage'];
    $retrievedMetaTitle                             = $foundCategory['MetaTitle'];
    $retrievedMetaDescription                       = $foundCategory['MetaDescription'];
    $retrievedMetaKeywords                          = $foundCategory['MetaKeywords'];

    $_SESSION['editCategory']                       = true; // Generate & redirect to edit tab
    ?>
        <script type="text/javascript">
            window.location.hash = '#editCategory';
        </script>
    <?php
}
if(isset($_POST['saveCategoryChanges'])) // When category changes are saved
{   // Retrieve current category details & new changes
    $categoryID                                     = mysqli_real_escape_string($dbconnect, $_POST['changeCategoryID']);
    $queryCurrentCategory                           = "SELECT * FROM `Categories` WHERE `CategoryID` = '$categoryID'";
    $currentCategory                                = mysqli_query($dbconnect, $queryCurrentCategory);
    $foundCategory                                  = mysqli_fetch_assoc($currentCategory);

    $retrievedCategoryName                          = $foundCategory['CategoryName'];
    $retrievedCategoryImage                         = $foundCategory['CategoryImage'];

    $newCategoryName                                = mysqli_real_escape_string($dbconnect, $_POST['changeCategoryName']);
    $newCategoryDescription                         = mysqli_real_escape_string($dbconnect, $_POST['changeCategoryDescription']);
    $newCategoryVisibility                          = isset($_POST['changeCategoryVisibility']) ? '1':'0';
    $newCategoryPopular                             = isset($_POST['changeCategoryPopular']) ? '1':'0';

    $newCategoryImage                               = "";
    $editCategory                                   = "";

    if(isset($_FILES['categoryChangeImage']['name'])) // Check if new category image is uploaded
    {   // If so, then create new file name for uploaded image to replace in database
        $newCategoryImage                           = $_FILES['categoryChangeImage']['name'];
        $image_ext                                  = pathinfo($newCategoryImage, PATHINFO_EXTENSION);
        $newImageTitle                              = time().'.'.$image_ext;
    }

    $oldCategoryImage                               = $_POST['oldImage'];

    $newMetaTitle                                   = mysqli_real_escape_string($dbconnect, $_POST['changeCategoryMetaTitle']);
    $newMetaDescription                             = mysqli_real_escape_string($dbconnect, $_POST['changeCategoryMetaDescription']);
    $newMetaKeywords                                = mysqli_real_escape_string($dbconnect, $_POST['changeCategoryMetaKeywords']);

    if($newCategoryName === $retrievedCategoryName) // Check if category name is unchanged then update
    {   // If new image is set, then new image name will be used to update database
        if($newCategoryImage != "")
        { $updateFileName                           = $newImageTitle; }
        else // Keep old image name otherwise
        { $updateFileName                           = $oldCategoryImage; }

        $queryEditCategory                          = "UPDATE `Categories` SET
                                                    `CategoryName`          = '$newCategoryName',
                                                    `CategoryDescription`   = '$newCategoryDescription',
                                                    `CategoryVisibility`    = '$newCategoryVisibility',
                                                    `CategoryPopular`       = '$newCategoryPopular',
                                                    `CategoryImage`         = '$updateFileName',
                                                    `MetaTitle`             = '$newMetaTitle',
                                                    `MetaDescription`       = '$newMetaDescription',
                                                    `MetaKeywords`          = '$newMetaKeywords',
                                                    `DateOfUpdate`          =  CURRENT_TIMESTAMP
                                                    WHERE `CategoryID`      = '$categoryID'";
        $editCategory                               = mysqli_query($dbconnect, $queryEditCategory);
    }
    else// Check if category name is already in use otherwise
    {   // Query database for existing records
        $queryCategoryUsed                          = "SELECT * FROM `Categories` WHERE `CategoryName` = '$newCategoryName'";
        $categoryUsed                               = mysqli_query($dbconnect, $queryCategoryUsed);

        if(mysqli_num_rows($categoryUsed) > 0) // If existing category found
        {   // Fire error alert & redirect to Categories table
            ?>
                <script type="text/javascript">
                    errorAlert("Category Taken!", "Please use another name for this category.");
                </script>
                <script type="text/javascript">
                    window.location.hash = '#Categories';
                </script>
            <?php // Remove edit tab
            unset($_SESSION['editCategory']);
        }
        else // Update category in database otherwise
        {   // If new image is set, then new image name will be used to update database
            if($newCategoryImage != "") 
            { $updateFileName                       = $newImageTitle; }
            else // Keep old image name otherwise
            { $updateFileName                       = $oldCategoryImage; }

            $queryEditCategory                      = "UPDATE `Categories` SET
                                                    `CategoryName`          = '$newCategoryName',
                                                    `CategoryDescription`   = '$newCategoryDescription',
                                                    `CategoryVisibility`    = '$newCategoryVisibility',
                                                    `CategoryPopular`       = '$newCategoryPopular',
                                                    `CategoryImage`         = '$updateFileName',
                                                    `MetaTitle`             = '$newMetaTitle',
                                                    `MetaDescription`       = '$newMetaDescription',
                                                    `MetaKeywords`          = '$newMetaKeywords',
                                                    `DateOfUpdate`          =  CURRENT_TIMESTAMP
                                                    WHERE `CategoryID`      = '$categoryID'";
            $editCategory                           = mysqli_query($dbconnect, $queryEditCategory);
        }
    }

    if($editCategory != "") // When category is updated
    {   // Check if new image was uploaded
        if($newCategoryImage != "")
        {   // Henceforth, move uploaded image to local uploads storage in category directory
            move_uploaded_file($_FILES['categoryChangeImage']['tmp_name'], $categoriesPath.'/'.$newImageTitle);
            if(file_exists("./images/uploads/categories/".$oldCategoryImage)) // If old image exists
            { unlink("./images/uploads/categories/".$oldCategoryImage); } // Remove old image
        }
        ?>  <!-- Fire success alert & redirect to Categories table -->
            <script type="text/javascript">
                successAlert("Category Updated!", "New category details are now live!");
            </script>
            <script type="text/javascript">
                window.location.hash = '#Categories';
            </script>
        <?php // Remove edit tab
        unset($_SESSION['editCategory']);
    }
    else if(mysqli_num_rows($categoryUsed) > 0) { return; } // If category name already used, do nothing
    else
    {   // Fire error alert & redirect to Categories table
        ?>
            <script type="text/javascript">
                errorAlert("Error...", "Something went wrong while trying to update category details...");
            </script>
            <script type="text/javascript">
                window.location.hash = '#Categories';
            </script>
        <?php
        unset($_SESSION['editCategory']); // Remove edit tab
    }
}
if(isset($_POST['cancelCategoryChanges'])) // When cancelled editing
{   // Remove edit tab & redirect to Categories table
    unset($_SESSION['editCategory']);
    ?>
        <script type="text/javascript">
            window.location.hash = '#Categories';
        </script>
    <?php
}
if(isset($_POST['sendCategoryDeleteID'])) // When category is to be deleted & confirmed
{   // Retrieve category details & delete category
    $deleteCategoryID                               = intval($_POST['sendCategoryDeleteID']);

    $queryGetCategoryImageDir                       = "SELECT * FROM `Categories` WHERE `CategoryID` = $deleteCategoryID";
    $getCategoryImageDir                            = mysqli_query($dbconnect, $queryGetCategoryImageDir);
    $categoryImageDir                               = mysqli_fetch_assoc($getCategoryImageDir);
    $categoryImage                                  = $categoryImageDir['CategoryImage'];

    $queryDeleteCategory                            = "DELETE FROM `Categories` WHERE `CategoryID` = $deleteCategoryID";
    $deleteCategory                                 = mysqli_query($dbconnect, $queryDeleteCategory);

    if($deleteCategory) // If deleted from database successfully
    {   // If old image exists, remove old image
        if(file_exists("./images/uploads/categories/".$categoryImage))
        { unlink("./images/uploads/categories/".$categoryImage); }
        ?>  <!-- Fire success alert -->
            <script text="text/javascript">
                successAlert("Category Successfully Deleted!", "This category has been removed from the database.");
            </script>
        <?php
    }
    else
    {   // Fire error alert
        ?>
            <script type="text/javascript">
                errorAlert("Error...", "Something went wrong while trying to delete this category...");
            </script>
        <?php
    }   // & redirect to Categories table
    ?>
        <script type="text/javascript">
            window.location.hash = '#Categories';
        </script>
    <?php
}

// Product Options
if(isset($_POST['submitProduct'])) // When new product added
{   // Retrieve new product details & image
    $productCategoryID                              = mysqli_escape_string($dbconnect, $_POST['productCategoryID']);
    $productName                                    = mysqli_escape_string($dbconnect, $_POST['productName']);
    $productVisibility                              = isset($_POST['productVisibility']) ? '1':'0';
    $productPopular                                 = isset($_POST['productPopular']) ? '1':'0';
    $productQuantity                                = mysqli_escape_string($dbconnect, $_POST['productQuantity']);
    $productRetailPrice                             = mysqli_escape_string($dbconnect, $_POST['productRetailPrice']);
    $productSellingPrice                            = mysqli_escape_string($dbconnect, $_POST['productSellingPrice']);
    $productDescription                             = mysqli_escape_string($dbconnect, $_POST['productDescription']);
    $productMetaTitle                               = mysqli_escape_string($dbconnect, $_POST['productMetaTitle']);
    $productMetaDescription                         = mysqli_escape_string($dbconnect, $_POST['productMetaDescription']);
    $productMetaKeywords                            = mysqli_escape_string($dbconnect, $_POST['productMetaKeywords']);

    $productImage                                   = $_FILES['productImage']['name'];
    $image_ext                                      = pathinfo($productImage, PATHINFO_EXTENSION);
    $filename                                       = time().'.'.$image_ext;

    if($productCategoryID == '----') // Check if category is assigned
    {   // Fire error alert & redirect to Products table
        echo '<p style="width: 100vw; height: 100vh; display: flex; align-items: center; justify-content: center;">Redirecting...</p>'
        ?>
            <script type="text/javascript">
                errorAlert("Please Select a Category!", "Products cannot be added without a category.");
            </script>
            <script type="text/javascript">
                setTimeout(function() {
                    if(window.location.href == "http://localhost/s2106630/public_html/admin-dashboard?error#ProductsTable"){
                        location.href = '?redirect#ProductsTable';
                    } else {
                        location.href = '?error#ProductsTable';
                    }
                    window.location.href = window.location.href;
                }, 3000);
            </script>
        <?php
        exit();
    }

    // Check if product with the same name already exists
    $queryProductExists                             = "SELECT * FROM `Products` WHERE `ProductName` = '$productName'";
    $productExists                                  = mysqli_query($dbconnect, $queryProductExists);

    if(mysqli_num_rows($productExists) > 0) // If product name already taken
    {   // Fire error alert & redirect to Products table
        ?>
            <script text="text/javascript">
                errorAlert("Product Name Taken!", "Please try using another name for this product.");
            </script>
            <script type="text/javascript">
                window.location.hash = '#ProductsTable';
            </script>
        <?php
    }
    else// If not taken
    {   // Then insert product record into database
        $insertProductQuery                         = "INSERT INTO `Products`( `ProductID`, `CategoryID`,
                                                        `ProductName`, `ProductDescription`, `ProductQuantity`,
                                                        `RetailPrice`, `SellingPrice`,
                                                        `ProductVisibility`, `ProductPopular`, `ProductImage`,
                                                        `MetaTitle`, `MetaDescription`, `MetaKeywords`,
                                                        `DateOfCreation`, `DateOfUpdate`
                                                    ) VALUES('', '$productCategoryID',
                                                        '$productName', '$productDescription', '$productQuantity',
                                                        '$productRetailPrice', '$productSellingPrice',
                                                        '$productVisibility', '$productPopular', '$filename',
                                                        '$productMetaTitle', '$productMetaDescription', '$productMetaKeywords',
                                                        CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
                                                    )";
        $insertProduct                              = mysqli_query($dbconnect, $insertProductQuery);
        if($insertProduct) // When product inserted
        {   // Move uploaded image to local uploads storage in product directory, fire success alert & redirect to Products table
            move_uploaded_file($_FILES['productImage']['tmp_name'], $productsPath.'/'.$filename);
            ?>
                <script type="text/javascript">
                    successAlert("Product Added!", "New product has been inserted into database.");
                </script>
                <script type="text/javascript">
                    window.location.hash = '#ProductsTable';
                </script>
            <?php
        }
        else
        {   // Fire error alert & redirect to Products panel
            ?>
                <script type="text/javascript">
                    errorAlert("Error...", "Something went wrong while trying to add this new product...");
                </script>
                <script type="text/javascript">
                    window.location.hash = '#Products';
                </script>
            <?php
        }
    }
}
if(isset($_POST['editProductButton'])) // When product is being edited
{   // Retrieve product details
    $productID                                      = mysqli_real_escape_string($dbconnect, $_POST['editProductID']);

    $queryCurrentProduct                            = "SELECT * FROM `Products` WHERE `ProductID` = '$productID'";
    $currentProduct                                 = mysqli_query($dbconnect, $queryCurrentProduct);
    $foundProduct                                   = mysqli_fetch_assoc($currentProduct);

    $retrievedProductCategoryID                     = $foundProduct['CategoryID'];

    $queryCurrentCategory                           = "SELECT * FROM `Categories` WHERE `CategoryID` = '$retrievedProductCategoryID'";
    $currentCategory                                = mysqli_query($dbconnect, $queryCurrentCategory);
    $foundProductCategory                           = mysqli_fetch_assoc($currentCategory);
    $retrievedProductCategory                       = $foundProductCategory['CategoryName'];

    $retrievedProductName                           = $foundProduct['ProductName'];
    $retrievedProductQuantity                       = $foundProduct['ProductQuantity'];
    $retrievedRetailPrice                           = $foundProduct['RetailPrice'];
    $retrievedSellingPrice                          = $foundProduct['SellingPrice'];
    $retrievedProductDescription                    = $foundProduct['ProductDescription'];
    $retrievedProductVisibility                     = $foundProduct['ProductVisibility'];
    $retrievedProductPopular                        = $foundProduct['ProductPopular'];
    $retrievedProductImage                          = $foundProduct['ProductImage'];
    $retrievedMetaTitle                             = $foundProduct['MetaTitle'];
    $retrievedMetaDescription                       = $foundProduct['MetaDescription'];
    $retrievedMetaKeywords                          = $foundProduct['MetaKeywords'];

    $_SESSION['editProduct']                        = true; // Generate & redirect to edit tab
    ?>
        <script type="text/javascript">
            window.location.hash = '#editProduct';
        </script>
    <?php
}
if(isset($_POST['saveProductChanges'])) // When product changes are saved
{   // Retrieve current product details & new changes
    $productID                                      = mysqli_real_escape_string($dbconnect, $_POST['changeProductID']);
    $queryCurrentProduct                            = "SELECT * FROM `Products` WHERE `ProductID` = '$productID'";
    $currentProduct                                 = mysqli_query($dbconnect, $queryCurrentProduct);
    $foundProduct                                   = mysqli_fetch_assoc($currentProduct);

    $retrievedProductName                           = mysqli_real_escape_string($dbconnect, $foundProduct['ProductName']);
    $retrievedProductImage                          = $foundProduct['ProductImage'];

    $newProductCategoryID                           = mysqli_real_escape_string($dbconnect, $_POST['changeProductCategoryID']);
    $newProductName                                 = mysqli_real_escape_string($dbconnect, $_POST['changeProductName']);
    $newProductQuantity                             = mysqli_real_escape_string($dbconnect, $_POST['changeProductQuantity']);
    $newRetailPrice                                 = mysqli_real_escape_string($dbconnect, $_POST['changeRetailPrice']);
    $newSellingPrice                                = mysqli_real_escape_string($dbconnect, $_POST['changeSellingPrice']);
    $newProductDescription                          = mysqli_real_escape_string($dbconnect, $_POST['changeProductDescription']);
    $newProductVisibility                           = isset($_POST['changeProductVisibility']) ? '1':'0';
    $newProductPopular                              = isset($_POST['changeProductPopular']) ? '1':'0';

    $newProductImage                                = "";

    if(isset($_FILES['productChangeImage']['name'])) // Check if new product image is uploaded
    {   // If so, then create new file name for uploaded image to replace in database
        $newProductImage                            = $_FILES['productChangeImage']['name'];
        $image_ext                                  = pathinfo($newProductImage, PATHINFO_EXTENSION);
        $newImageTitle                              = time().'.'.$image_ext;
    }

    $oldProductImage                                = $_POST['oldImage'];

    $newMetaTitle                                   = mysqli_real_escape_string($dbconnect, $_POST['changeProductMetaTitle']);
    $newMetaDescription                             = mysqli_real_escape_string($dbconnect, $_POST['changeProductMetaDescription']);
    $newMetaKeywords                                = mysqli_real_escape_string($dbconnect, $_POST['changeProductMetaKeywords']);

    if($newProductName === $retrievedProductName) // Check if product name is unchanged then update
    {   // If new image is set, then new image name will be used to update database
        if($newProductImage != "")
        { $updateFileName                           = $newImageTitle; }
        else // Keep old image name otherwise
        { $updateFileName                           = $oldProductImage; }

        $queryEditProduct                           = "UPDATE `Products` SET
                                                    `CategoryID`            = '$newProductCategoryID',
                                                    `ProductName`           = '$newProductName',
                                                    `ProductQuantity`       = '$newProductQuantity',
                                                    `RetailPrice`           = '$newRetailPrice',
                                                    `SellingPrice`          = '$newSellingPrice',
                                                    `ProductDescription`    = '$newProductDescription',
                                                    `ProductVisibility`     = '$newProductVisibility',
                                                    `ProductPopular`        = '$newProductPopular',
                                                    `ProductImage`          = '$updateFileName',
                                                    `MetaTitle`             = '$newMetaTitle',
                                                    `MetaDescription`       = '$newMetaDescription',
                                                    `MetaKeywords`          = '$newMetaKeywords',
                                                    `DateOfUpdate`          =  CURRENT_TIMESTAMP
                                                    WHERE `ProductID`       = '$productID'";
        $editProduct                                = mysqli_query($dbconnect, $queryEditProduct);
    }
    else// Check if product name is already in use otherwise
    {   // Query database for existing records
        $queryProductUsed                           = "SELECT * FROM `Products` WHERE `ProductName` = '$newProductName'";
        $productUsed                                = mysqli_query($dbconnect, $queryProductUsed);

        if(mysqli_num_rows($productUsed) > 0) // If existing product found
        {      // Fire error alert & redirect to Products table
            ?>
                <script type="text/javascript">
                    errorAlert("Product Name Taken!", "Please try another name for this product.");
                </script>
                <script type="text/javascript">
                    window.location.hash = '#ProductsTable';
                </script>
            <?php // Remove edit tab
            unset($_SESSION['editProduct']);
        }
        else // Update product in database otherwise
        {   // If new image is set, then new image name will be used to update database
            if($newProductImage != "")
            { $updateFileName                       = $newImageTitle; }
            else // Keep old image name otherwise
            { $updateFileName                       = $oldProductImage; }

            $queryEditProduct                       = "UPDATE `Products` SET
                                                    `CategoryID`            = '$newProductCategoryID',
                                                    `ProductName`           = '$newProductName',
                                                    `ProductQuantity`       = '$newProductQuantity',
                                                    `RetailPrice`           = '$newRetailPrice',
                                                    `SellingPrice`          = '$newSellingPrice',
                                                    `ProductDescription`    = '$newProductDescription',
                                                    `ProductVisibility`     = '$newProductVisibility',
                                                    `ProductPopular`        = '$newProductPopular',
                                                    `ProductImage`          = '$updateFileName',
                                                    `MetaTitle`             = '$newMetaTitle',
                                                    `MetaDescription`       = '$newMetaDescription',
                                                    `MetaKeywords`          = '$newMetaKeywords',
                                                    `DateOfUpdate`          =  CURRENT_TIMESTAMP
                                                    WHERE `ProductID`       = '$productID'";
            $editProduct                            = mysqli_query($dbconnect, $queryEditProduct);
        }
    }
    if($editProduct)  // When product is updated
    {   // Check if new image was uploaded
        if($newProductImage != "")
        {   // Henceforth, move uploaded image to local uploads storage in product directory
            move_uploaded_file($_FILES['productChangeImage']['tmp_name'], $productsPath.'/'.$newImageTitle);
            if(file_exists("./images/uploads/products/".$oldProductImage)) // If old image exists
            { unlink("./images/uploads/products/".$oldProductImage); } // Remove old image
        }
        ?>  <!-- Fire success alert & redirect to Products table -->
            <script type="text/javascript">
                successAlert("Changes Saved!", "Product details have been updated. New details are live!");
            </script>
            <script type="text/javascript">
                window.location.hash = '#ProductsTable';
            </script>
        <?php
        unset($_SESSION['editProduct']);
    }
    else if(mysqli_num_rows($productUsed) > 0) { return; } // If product name already used, do nothing
    else
    {   // Fire error alert & redirect to Products table
        ?>
            <script type="text/javascript">
                errorAlert("Error...", "Something went wrong while trying to update product details...");
            </script>
            <script type="text/javascript">
                window.location.hash = '#ProductsTable';
            </script>
        <?php 
        unset($_SESSION['editProduct']); // Remove edit tab
    }
}
if(isset($_POST['cancelProductChanges'])) // When cancelled editing
{   // Remove edit tab & redirect to Products table
    unset($_SESSION['editProduct']);
    ?>
        <script type="text/javascript">
            window.location.hash = '#ProductsTable';
        </script>
    <?php
}

if(isset($_POST['sendProductDeleteID'])) // When product is to be deleted & confirmed
{   // Retrieve product details & delete product
    $deleteProductID                                = intval($_POST['sendProductDeleteID']);

    $queryGetProductImageDir                        = "SELECT * FROM `Products` WHERE `ProductID` = $deleteProductID";
    $getProductImageDir                             = mysqli_query($dbconnect, $queryGetProductImageDir);
    $productImageDir                                = mysqli_fetch_assoc($getProductImageDir);
    $productImage                                   = $productImageDir['ProductImage'];

    $queryDeleteProduct                             = "DELETE FROM `Products` WHERE `ProductID` = $deleteProductID";
    $deleteProduct                                  = mysqli_query($dbconnect, $queryDeleteProduct);

    if($deleteProduct) // If deleted from database successfully
    {
        if(file_exists("./images/uploads/products/".$productImage))
        {    // If old image exists, remove old image
            unlink("./images/uploads/products/".$productImage);
            ?>  <!-- Fire success alert -->
                <script type="text/javascript">
                    successAlert("Successfully Deleted!", "Product has been removed from database.");
                </script>
            <?php
        }
        else
        {   // Fire error alert
            ?>
                <script type="text/javascript">
                    errorAlert("Error...", "Image could not be removed. Please remove manually.");
                </script>
            <?php
        }
    }
    else
    {
        ?>
            <script type="text/javascript">
                errorAlert("Error...", "Something went wrong while trying to delete this product...");
            </script>
        <?php
    }   // & redirect to Products table
    ?>
        <script type="text/javascript">
            window.location.hash = '#ProductsTable';
        </script>
    <?php
}
?>