function check(event)
{
    var n1 = document.getElementById("nbr1").value;
    var n2 = document.getElementById("nbr2").value;
    if (n1 == "" || n2 == "")
    {
    alert("Veuillez remplir tous les champs ><");
    event.preventDefault();
    return false;
    }
    n1 = Number(n1);
    n2 = Number(n2);
    if (isNaN(n1) || isNaN(n2))
    {
    alert("Veuillez entrer des nombres ><");
    event.preventDefault();
    return false;
    }
    if (n1 < 1 || n2 < 1)
    {
    alert("Veuillez entrer des nombres superieur a 0 ><");
    event.preventDefault();
    return false;
    }
}

document.getElementById("boutton").addEventListener('click', check);
