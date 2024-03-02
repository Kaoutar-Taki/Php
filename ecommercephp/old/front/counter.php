<div>
    <?php
        $idUser = $_SESSION['utilisateur']['id'];
        $Quantity = $_SESSION['cart'][$idUser][$idProduct] ?? 0;
        $button = $Quantity == 0 ? 'Add to Cart' : 'Update Cart';
    ?>  
    <form method="post" action="addCard.php">
        <label for="Quantity" class="sr-only"> Quantity </label>
        <div class="flex justify-center items-center gap-1">
            <button type="button" onclick="return false;" class="h-10 w-10 leading-10 text-gray-600 transition hover:opacity-75 counter-minus">
                &minus;
            </button>
            <input type="hidden" name="id" id="id" value="<?php echo $idProduct ?>" class="sr-only h-10 w-16 rounded border-gray-200 text-center [-moz-appearance:_textfield] sm:text-sm [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none" />
            <input type="number" name="Quantity" id="Quantity" value="<?php echo $Quantity ?>" class="h-10 w-16 rounded border-gray-200 text-center [-moz-appearance:_textfield] sm:text-sm [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none" />
            <button type="button" onclick="return false;" class="h-10 w-10 leading-10 text-gray-600 transition hover:opacity-75 counter-plus">
                &plus;
            </button>
        </div>
        <div class="mt-2">
            <input type="submit" name="addCard" class="w-full bg-gray-900 text-white py-2 px-4 rounded-full font-bold hover:bg-gray-800" value="<?php echo $button ?>">
        </div>
    </form>
</div>