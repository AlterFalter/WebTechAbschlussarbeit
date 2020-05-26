window.onload = function() {
    console.log("page loaded")
    drawDollarSigns()
    readCookie()
    registerChangeInDeposit();
}

function registerChangeInDeposit() {
    document.getElementById("deposit").onchange = function() {
        validateDeposit()
    }
}

function validateDeposit() {
    // smaller deposit possible when frequency is on monthly
    let depositInput = document.getElementById('deposit')
    let deposit = depositInput.value
    let monthlyDepositMin = depositInput.min
    let monthlyDepositMax = depositInput.max

    let frequency = getFrequency()
    let errorMessage = ""

    if (frequency === "monthly" && (monthlyDepositMin * 10 > deposit || deposit > monthlyDepositMax / 10) && deposit.length > 0) {
        errorMessage = "Monatliche Einzahlung muss im Bereich sein von " + monthlyDepositMin + " bis " + monthlyDepositMax + "!"
    }
    else if (frequency === "yearly" && !depositInput.checkValidity()) {
        errorMessage = depositInput.validationMessage
    }

    document.getElementById("depositError").innerText = errorMessage
    return errorMessage === ""
}

function getFrequency() {
    let frequencyInput = document.getElementById("frequency")
    let frequency = frequencyInput.options[frequencyInput.selectedIndex].value
    return frequency
}

function frequencyChanged() {
    let usesDeposits = getFrequency() === "noDeposit"
    document.getElementById("deposit").disabled = usesDeposits
    validateDeposit()
}

function validateName() {
    const errorBorderClass = "w3-border-red"
    let fullName = document.getElementById('name').value
    // regex for full name
    let regex = /^([A-Z]{1}[a-z]{1,}\s{1}[A-Z]{1}[a-z]{1,})$/
    
    let regexMatches = fullName.match(regex)
    if (regexMatches) {
        document.getElementById("name").classList.remove(errorBorderClass)
        document.getElementById("nameError").hidden = true
        return true
    }
    else {
        document.getElementById("name").classList.add(errorBorderClass)
        document.getElementById("nameError").hidden = false
        return false
    }
}
function isNumberFormatCorrect(numberToCheck) {
    // only allow 0-9, opt. - in the front, opt. . for float comma
    let regex = /[0-9]{1,10}\.{0,1}[0-9]{0,2}$/
    return numberToCheck.match(regex)
}

function currencyChanged() {
    let startCurrency = document.getElementById("startCurrency")
    let endCurrency = document.getElementById("endCurrency")

    let currenciesAreTheSame = startCurrency.value === endCurrency.value
    document.getElementById("additionalFeatureSubmitButton").disabled = currenciesAreTheSame
    document.getElementById("errorField").hidden = !currenciesAreTheSame
}

function checkValuesBeforeSending() {
    let nameIsFine = validateName()

    let depositIsFine = validateDeposit()

    // stop or allow submit
    return nameIsFine && depositIsFine
}

function readCookie() {
    let cookie = document.cookie
    let name = cookie.split("=")[1]
    name = name.replace("%20", " ")
    console.log("full cookie: " + cookie + " | name: " + name)
    document.getElementById("name").value = name
}
