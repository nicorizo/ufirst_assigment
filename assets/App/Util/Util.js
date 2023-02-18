export const parseDataToGraph = (data) => {
    let values = [];
    Object.keys(data).map((item) => {
        values.push({
            name: item,
            amount: data[item]
        })
    });
    return values;
}