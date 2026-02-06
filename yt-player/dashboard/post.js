// ✅ Make sure it's globally accessible
window.copyBPlAdminShortcode = async function (postID) {
  const wrapper = document.querySelector(`#bPlAdminShortcode-${postID}`);
  if (!wrapper) return;

  const input = wrapper.querySelector("input");
  const tooltip = wrapper.querySelector(".tooltip");
  const text = input.value;

  try {
    await navigator.clipboard.writeText(text);
    tooltip.textContent = "Copied!";
    tooltip.style.opacity = 1;
    tooltip.style.visibility = "visible";

    setTimeout(() => {
      tooltip.style.opacity = 0;
      tooltip.style.visibility = "hidden";
      tooltip.textContent = "Copy to Clipboard";
    }, 1500);
  } catch (err) {
    fallbackCopy(text, tooltip);
  }
};

function fallbackCopy(text, tooltip) {
  const temp = document.createElement("textarea");
  temp.value = text;
  document.body.appendChild(temp);
  temp.select();
  temp.setSelectionRange(0, 99999);

  try {
    document.execCommand("copy");
    tooltip.textContent = "Successful Copied!";
  } catch (err) {
    tooltip.textContent = "Failed!";
  }

  tooltip.style.opacity = 1;
  tooltip.style.visibility = "visible";
  tooltip.style.width = "120px";
  tooltip.style.textAlign = 'center';
  tooltip.style.fontWeight = '400';
  tooltip.style.fontSize = '14px'
  tooltip.style.padding = "3px 5px";

  setTimeout(() => {
    tooltip.style.opacity = 0;
    tooltip.style.visibility = "hidden";
    tooltip.textContent = "Copy to Clipboard";
  }, 1500);

  document.body.removeChild(temp);
}
