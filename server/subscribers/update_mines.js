export default function updateBank() {
  return ({ time, message }) => {
    console.log(`${time}\t${message}`);
  }
};
