import { getAttributesGroup } from './attributeGroups';

const attributeGroupsSearch = document.querySelector('[data-attribute-groups-search]');
const selectAttributeGroup = document.querySelector("[data-attribute-groups]");

const turnOnListener = () => {
  attributeGroupsSearch.addEventListener('input', () => {
    const phrase = attributeGroupsSearch.value;

    getAttributesGroup(phrase);
  });

  attributeGroupsSearch.addEventListener('focus', () => {
    selectAttributeGroup.classList.add('visible');
    selectAttributeGroup.style.display = 'block';
  });

  attributeGroupsSearch.addEventListener('focusout', () => {
    setTimeout(() => {
      selectAttributeGroup.classList.remove('visible');
      selectAttributeGroup.style.display = 'none';
    }, 100);
  });
}

const init = () => {
  if(attributeGroupsSearch && selectAttributeGroup) {
    getAttributesGroup('');
    turnOnListener();
  }
}

init();
