import { defineStore } from "pinia";
import { ref } from "vue";
import * as XLSX from "xlsx";
import { dayjs } from "element-plus";

export const useDataStore = defineStore("dataStore", () => {
  const dataList = ref([]);

  const initData = async () => {
    try {
      // 处理 excel 文件
      const response = await fetch("/data.xlsx");
      const arrayBuffer = await response.arrayBuffer();
      const workbook = XLSX.read(arrayBuffer, {
        type: "array",
        cellDates: true,
      });

      // 遍历所有 sheet
      workbook.SheetNames.forEach((sheetName) => {
        const sheet = workbook.Sheets[sheetName];
        const jsonData = XLSX.utils
          .sheet_to_json(sheet, { header: 0 })
          .map((row) => {
            // 解析日期列并格式化
            const newRow = {};
            for (const key in row) {
              if (row[key] instanceof Date) {
                newRow[key] = dayjs(row[key]).format("YYYY-MM-DD hh:mm:ss");
              } else {
                newRow[key] = row[key];
              }
            }
            return newRow;
          });

        dataList.value.push(...jsonData);
      });
    } catch (error) {
      console.error("file parse error:", error);
    }
  };

  const doSearch = (titleStr, topRouteStr) => {
    const lowerCaseTitle = titleStr.toLowerCase();
    const lowerCaseTopRoute = topRouteStr ? topRouteStr.toLowerCase() : null;

    if (lowerCaseTopRoute) {
      return dataList.value
        .filter(
          ({ topRoute }) =>
            topRoute.toLowerCase().indexOf(lowerCaseTopRoute) === 0,
        )
        .filter(({ title }) => title.toLowerCase().includes(lowerCaseTitle));
    }

    return dataList.value.filter(({ title }) =>
      title.toLowerCase().includes(lowerCaseTitle),
    );
  };

  const loadData = (route) => {
    const { title, slogan } = route.meta;
    const target = dataList.value.filter(({ category, topRoute }) => {
      return category.indexOf(title) === 0 || topRoute.indexOf(title) === 0;
    });
    return {
      data: target,
      tips: `${title}【${target.length}】：${slogan}`,
    };
  };

  return {
    initData,
    loadData,
    doSearch,
  };
});
