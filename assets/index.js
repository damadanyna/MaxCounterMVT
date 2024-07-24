function runCounter() {
    var agency = getAgency()
    agency.push('sipem_conso')
    sendRequest(agency);

}

function getAgency() {
    var agency = ['00001', '00002', '00003', '00004', '00005', '00006', '00007', '00008', '00009', '00010', '00011', '00012', '00013', '00021', '00022', '00023', '00024', '00025', '00031', '00041', '00051', '00052', '00053', '00054', '00061'];
    var array = [];
    agency.forEach(element => {
        array.push('sipem_' + element)
    });
    return array;
}


function sendRequest(array) {
    let tableBody = '';
    let completedRequests = 0;
    let mvt = [];
    let dmvt = [];

    array.forEach(element => {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./controller/user.controller.php?action=getMetaDATA", true);
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                completedRequests++;

                if (xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        tableBody += `
                            <tr>
                                <td>${response.agency}</td>
                                <td>${response.movement[0].max_mvt_inum}</td>
                                <td>${response.detail[0].max_dmv_inum}</td>
                            </tr>
                        `;
                        // Ajoutez directement l'objet au tableau
                        mvt.push({ agency: response.agency, mvt: response.movement[0].max_mvt_inum });
                        dmvt.push({ agency: response.agency, dmvt: response.detail[0].max_dmv_inum });

                    } catch (error) {
                        console.error('Erreur lors du parsing JSON:', error);
                    }
                } else {
                    console.error(`Erreur HTTP: ${xhr.status}`);
                }
                if (completedRequests === array.length) {
                    document.getElementById('table-body').innerHTML = tableBody;
                    max(mvt, dmvt);
                }
            }
        };

        const data = JSON.stringify({ data: element });
        xhr.send(data);
    });
}

function max(mvts, dmvts) {
    mvts.sort((a, b) => b.mvt - a.mvt);
    dmvts.sort((a, b) => b.dmvt - a.dmvt);

    // Afficher la valeur 'mvt' la plus haute
    const highestMvt = mvts[0];
    const highestDmvt = dmvts[0];
    // console.log('La valeur mvt la plus haute est :', highestMvt);
    document.getElementById('db_val').innerHTML = highestMvt.agency;
    document.getElementById('mvt_val').innerHTML = highestMvt.mvt;

    document.getElementById('db_dval').innerHTML = highestDmvt.agency;
    document.getElementById('dmvt_val').innerHTML = highestDmvt.dmvt;

    // console.log('La valeur dmvt la plus haute est :', highestDmvt);
}

function quickSort(arr) {
    return sortedArray = arr.slice().sort((a, b) => {
        return a.mvt - b.mvt
    });

}