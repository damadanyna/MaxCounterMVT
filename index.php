<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="./assets/tailwind.js"></script>
    <script src="./assets/index.js"></script>
    <link rel="stylesheet" href="./assets/style.css">
    <title>Count MAX</title>
</head>

<body class=" h-screen">
    <div class="flex w-full h-full items-center  flex flex-col px-5  ">
        <div class="w-full   flex justify-between py-5">
            <button onclick="runCounter()" class="bg-green-600 py-2 text-white px-5 rounded-md">
                <i class="fas fa-play"></i>
                Lancer le compteur
            </button>

            <div class="flex space-x-4">
                <div class="flex flex-col">
                    <div class="">
                        <span clas="mx-3">DB:</span>
                        <span id="db_val" class=" text-xl font-bold text-red-500">0</span>
                    </div>
                    <div class="mr-4">
                        <span clas="mx-3">MVT:</span>
                        <span id="mvt_val" class=" text-xl font-bold text-red-500">0</span>
                    </div>
                </div>
                <span class=" mx-9">|</span>
                <div class="flex flex-col">

                    <div class=" ml-4">
                        <span clas="mx-3">DB:</span>
                        <span id="db_dval" class=" text-xl font-bold text-red-500">0</span>
                    </div>
                    <div class="">
                        <span clas="mx-3">Detail MVT:</span>
                        <span id="dmvt_val" class=" text-xl font-bold text-red-500">0</span>
                    </div>
                </div>
            </div>
        </div>

        <div class=" h-[70] w-full">

            <table id="customers">
                <thead>
                    <tr class="bg-green-600">
                        <th>Agence</th>
                        <th>MVT</th>
                        <th>Détail MVT</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <!-- Les lignes de données seront insérées ici -->
                </tbody>
            </table>
        </div>


    </div>
</body>

</html>