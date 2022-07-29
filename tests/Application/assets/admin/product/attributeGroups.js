const getAttributesGroup = async () => {
    const response = await fetch(urlAttributesGroup, {
        headers: {
            Accept: "application/json",
        },
    })
    const data = await response.json()
    const selectAttributeGroup = document.querySelector("[data-attribute-groups]")

    for (let i = 0; i < data.length; i++) {
        let item = document.createElement("div")

        item.dataset.testCollectionAtributesSelect = i;
        item.innerHTML = data[i].name
        item.classList.add("item")
        item.id = `attributeGroup-${data[i].name}`
        item.addEventListener("click", function () {
            selectAttributes(data[i].attributeCodes)
        })

        selectAttributeGroup.appendChild(item)
    }
}

const selectAttributes = codes => {
    const attributes = document.querySelectorAll("[data-attributes] ~ .menu .item")

    for (let i = 0; i < attributes.length; i++) {
        if (codes.includes(attributes[i].dataset.value)) {
            attributes[i].click()
        }
    }
}

if(typeof urlAttributesGroup !== 'undefined') {
    getAttributesGroup()
}
