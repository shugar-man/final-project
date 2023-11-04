// import {type MultiPartData} from 'h3' 
// import {createStorage} from 'unstorage'
// import fsLiteDriver from 'unstorage/drivers/fs-lite'
// import {randomUUID} from 'node:crypto'
// const storage  = createStorage({
//     driver: fsLiteDriver({ base: './resources'})
// })


// const FILE_KEYS = ['name','filename','type','data'];

// const isFile = (data:MultiPartData) => {
//     return Object.keys(data).filter((key) => FILE_KEYS.indexOf(key) !== -1).length === FILE_KEYS.length;

// };

// const parseMultipart = (data?: MultiPartData[]) => {
//     const arr = (Array.isArray(data) ? data : []) as MultiPartData[];

//     const result = arr.reduce((prev:Record<string,any>,curr) => {
//         prev[String(curr.name)] = isFile(curr) ? curr: curr.data.toString('utf8')
//         return prev ;
//     },{})
//     return result;

// };
// const saveFile = async (file :MultiPartData) => {
//     const [_mine,ext] = String(file.type).split('/')
//     const fileName =randomUUID() + '.' + ext;

//     await storage.setItemRaw(fileName,file.data)
// }
//  export default defineEventHandler(async (event) => {
//     try {
//         const body = await readMultipartFormData(event);
//         const parsed = parseMultipart(body)
//         if(parsed.file) {
//             await saveFile(parsed.file)
//         }
//         return { success:true};
//     } catch (err) {
//         console.log(err);
//         throw createError ({
//             statusCode: 500,
//             statusMessage: "Something went wrong"
//         });
//     }
//  })