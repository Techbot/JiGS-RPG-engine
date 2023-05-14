export default async function ({ app }) {
  await events({ app });
  return app;
}
