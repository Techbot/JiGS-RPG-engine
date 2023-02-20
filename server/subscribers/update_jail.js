export default function updateJail() {
  return ({ time, message }) => {
    console.log(`${time}\t${message}`);
  }
};
