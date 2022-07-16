export function getAvatarUrl(item) {
  let fullname = [];

  if (item.lastname) {
    fullname[0] = item.lastname.substring(0, 1);
  }

  if (item.firstname) {
    fullname[1] = item.firstname.substring(0, 1);
  }

  return `https://eu.ui-avatars.com/api/?name=${fullname}`;
}
